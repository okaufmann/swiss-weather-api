<?php
/*
 * swiss-weather-api
 *
 * This File belongs to to Project swiss-weather-api
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 */

namespace Okaufmann\SwissMeteoApi;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client as Http;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Collection;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Log;

class Client extends ClientAbstract
{
    use MeasuredValues;
    use Forecast;
    use Metadata;

    /**
     * @var Http
     */
    public $client;

    private $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36';
    private $baseUri = 'http://www.meteoschweiz.admin.ch/';

    public function __construct()
    {
        $this->setupClient();
    }

    private function setupClient()
    {
        // Create default HandlerStack
        $stack = HandlerStack::create();

        $stack->push(
            new CacheMiddleware(
                new PrivateCacheStrategy(
                    new LaravelCacheStorage(
                        Cache::store('file')
                    )
                )
            ),
            'weather-cache'
        );

        $client = new Http([
            'handler' => $stack,
            'base_uri' => $this->baseUri,
            'headers' => [
                'User-Agent' => $this->userAgent
            ]
        ]);

        $this->client = $client;
    }

    private function makeRequest($url, $decodeJson = false)
    {
        $response = $this->client->get($url);
        $html = (string)$response->getBody();

        if ($decodeJson) {
            return json_decode($html, true);
        }

        return $html;
    }

    private function getUtcDate($timestamp)
    {
        if (!$timestamp || $timestamp == 0) {
            throw new \Exception('Invalid timestamp provided: '.$timestamp);
        }

        try {
            if (strlen($timestamp) == 13) {
                $timestamp = doubleval($timestamp) / 1000;
            }
            $date = Carbon::createFromTimestamp($timestamp, 'Europe/Zurich');
            $date->setTimezone('UTC');
        } catch (\Exception $ex) {
            Log::error('Error converting timestamp to datetime', ['timestamp' => $timestamp]);
            throw $ex;
        }

        return $date;
    }

    private function humanizeString($input)
    {

        $str = trim(strtolower($input));
        $str = preg_replace('/[^a-z0-9\s+]/', ' ', $str);
        $str = preg_replace('/\s+/', ' ', $str);
        $str = explode(' ', $str);

        $str = array_map('ucwords', $str);

        return implode(' ', $str);
    }

    private function getParameterSuffix($parameterName)
    {
        if (starts_with($parameterName, 'temperature')) {
            return 'C°';
        }

        if (starts_with($parameterName, 'wind')) {
            return 'km/h';
        }

        if (starts_with($parameterName, 'rainfall')) {
            return 'mm/h';
        }

        return '';
    }

    private function formatParameterValues($values, $parameterName, $variance = false)
    {
        if(!$values) {
            return [];
        }

        if (!$values instanceof Collection) {
            $values = collect($values);
        }

        $data = $values->map(function ($value) use ($variance) {
            $dateTime = $this->getUtcDate($value[0]);
            $valueData = [
                'datetime' => $dateTime,
                'value' => doubleval($value[1]),
            ];

            if ($variance) {
                $valueData['max'] = $value[2];
            }

            return $valueData;
        });

        return [
            'label' => $this->humanizeString($parameterName),
            'type' => $parameterName,
            'value_suffix' => $this->getParameterSuffix($parameterName),
            'data' => $data
        ];
    }
}