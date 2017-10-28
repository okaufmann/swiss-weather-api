<?php

namespace Okaufmann\SwissMeteoApi;

use Illuminate\Support\Facades\Facade;
use Okaufmann\SwissMeteoApi\Client as WeatherClient;

class Weather extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @see \Okaufmann\SwissMeteoApi\Client
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return WeatherClient::class;
    }
}