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

use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

trait Forecast
{
    public function getTemperatureForecast($postalCode, $lang = 'en')
    {
        $parameterName = self::PARAMETER_TEMPERATURE;
        $data = $this->getForecastData($postalCode, $parameterName, $lang);

        return $data;
    }

    public function getRainfallForecast($postalCode, $lang = 'en')
    {
        $parameterName = self::PARAMETER_RAINFALL;
        $data = $this->getForecastData($postalCode, $parameterName, $lang);

        return $data;
    }

    // TODO: Handle special format
    //public function getWindForecast($postalCode, $lang = 'en')
    //{
    //    $parameterName = self::PARAMETER_WIND;
    //    $data = $this->getForecastData($postalCode, $parameterName, $lang);
    //
    //    return $data;
    //}

    private function getForecastData($postalCode, $parameterName, $lang)
    {
        $locationId = $postalCode;
        if (strlen($postalCode) == 4) {
            $locationId = $postalCode.'00';
        }

        $version = $this->getParametersAndVersionsForecast();

        $locationData = $this->loadLocationData($locationId);
        $data = $this->loadForecastData($version['version'], $lang, $locationId);
        $forecast = $this->formatForecastData($data, $locationData, $parameterName);

        return $forecast;
    }

    private function loadForecastData($version, $lang, $locationId)
    {
        $url = 'product/output/forecast-chart/'.$version.'/'.$lang.'/'.$locationId.'.json';

        $forecastData = $this->makeRequest($url, true);

        return $forecastData;
    }

    private function loadLocationData($locationId)
    {
        $url = 'etc/designs/meteoswiss/ajax/location/'.$locationId.'.json';

        $locationData = $this->makeRequest($url, true);

        return $locationData;
    }

    private function formatForecastData($data, $locationData, $parameterName)
    {
        // wind
        // temperature, variance_range
        // rainfall, variance_rain

        $days = collect($data)->map(function ($day) use ($parameterName) {

            $minDate = $this->getUtcDate($day['min_date']);
            $maxDate = $this->getUtcDate($day['max_date']);
            $dayName = $day['day_string'];

            $forecastForParameter = $day[$parameterName];

            $parameters = [];
            $parameters[] = $this->formatParameterValues(collect($forecastForParameter), $parameterName);

            // load additional parameter values for certain parameters
            if ($parameterName == self::PARAMETER_TEMPERATURE) {
                $parameters[] = $this->formatParameterValues(collect($day[self::PARAMETER_TEMPERATURE_VARIANCE]), 'temperature_variance', true);
            } else if ($parameterName == self::PARAMETER_RAINFALL) {
                $parameters[] = $this->formatParameterValues(collect($day[self::PARAMETER_RAINFALL_VARIANCE]), 'rainfall_variance', true);
            }

            $dayData = [
                'forecast_from' => $minDate,
                'forecast_to' => $maxDate,
                'day' => $dayName,
                'parameters' => $parameters
            ];

            return $dayData;
        });

        $location = [
            'city_name' => $locationData['city_name'],
            'city_postal_code' => intval(substr($locationData['location_id'], 0, 4)),
            'location_id' => $locationData['location_id'],
            'station_id' => $locationData['station_id'],
            'webcam_id' => $locationData['webcam_id']
        ];

        $data = [
            'meta' => $location,
            'forecast' => $days
        ];

        return $data;
    }

    /**
     * Fetches all version tags from frontend html page to access api endpoints
     */
    private function getParametersAndVersionsForecast()
    {
        $url = 'home.html';
        $html = $this->makeRequest($url);

        // http://www.meteoswiss.admin.ch/product/output/forecast-chart/version__20171112_1532/en/380000.json
        $regex = '/product\/output\/forecast-chart\/(version__[0-9]{6,8}_[0-9]{2,4})\/(de)/';
        $matches = Regex::matchAll($regex, $html);

        if (!$matches->hasMatch()) {
            throw new \Exception('current version segment could\'nt be found!');
        }

        /** @var MatchResult $match */
        $match = array_first($matches->results());

        $parameterVersion = [
            'version' => $match->group(1),
            'lang' => $match->group(2)
        ];

        return $parameterVersion;
    }
}