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

use Carbon\Carbon;
use GuzzleHttp\Client as Http;
use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

class Client extends ClientAbstract
{
    use MeasuredValues;
    use Forecast;

    /**
     * @var Http
     */
    public $client;


    private function setupClient()
    {
        $client = new Http([
            'base_uri' => 'http://www.meteoschweiz.admin.ch/'
        ]);

        $this->client = $client;
    }

    /**
     * @param $stationId
     * @param $station
     * @return array
     */
    private function formatData($stationId, $station)
    {
        $parameters = [];
        foreach ($station['series'] as $parameter) {
            $parameters[] = [
                'label' => $parameter['name'],
                'value_suffix' => $station['chart_options']['value_suffix'],
                'data' => collect($parameter['data'])
                    ->map(function ($dataItem) {
                        return [
                            'date' => $this->getUtcDate($dataItem[0]),
                            'value' => $dataItem[1]
                        ];
                    })
                    ->toArray(),
            ];
        }

        $data = [
            'meta' => [
                'value_suffix' => $station['chart_options']['value_suffix'],
                'timestamp' => $this->getUtcDate($station['config']['timestamp']),
                'language' => $station['config']['language'],
                'station' => $stationId
            ],
            'parameters' => $parameters
        ];

        return $data;
    }

    private function getUtcDate($timestamp)
    {
        $timestamp = floatval($timestamp / 1000);
        $date = Carbon::createFromTimestamp($timestamp, 'Europe/Zurich');
        $date->setTimezone('UTC');

        return $date;
    }
}