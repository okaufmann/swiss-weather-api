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
use Log;

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


    private function getUtcDate($timestamp)
    {

        if (!$timestamp || $timestamp == 0) {
            throw new \Exception('Invalid timestamp provided: '.$timestamp);
        }

        try {
            $timestamp = doubleval($timestamp) / 1000;
            $date = Carbon::createFromTimestamp($timestamp, 'Europe/Zurich');
            $date->setTimezone('UTC');
        } catch (\Exception $ex) {
            Log::error('Error converting timestamp to datetime', ['timestamp' => $timestamp]);
            dd($timestamp);
            throw $ex;
        }


        return $date;
    }
}