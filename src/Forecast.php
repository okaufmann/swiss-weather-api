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

use Illuminate\Support\Collection;
use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

trait Forecast
{

    /**
     * @var array
     */
    public $parameterVersionForecast;

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
        if (strlen($postalCode) == 4) {
            $postalCode = $postalCode.'00';
        }

        $version = $this->getParametersAndVersionsForecast();

        $data = $this->loadForecastData($version['version'], $lang, $postalCode);
        $forecast = $this->formatForecastData($data, $parameterName);

        return $forecast;
    }

    private function loadForecastData($version, $lang, $postalCode)
    {
        $url = 'product/output/forecast-chart/'.$version.'/'.$lang.'/'.$postalCode.'.json';

        $forecastData = $this->makeRequest($url, true);

        return $forecastData;
    }

    private function formatForecastData($data, $parameterName)
    {
        // wind
        // temperature, variance_range
        // rainfall, variance_rain

        $days = collect($data)->map(function ($day) use ($parameterName) {

            $minDate = $this->getUtcDate($day['min_date']);
            $maxDate = $this->getUtcDate($day['max_date']);
            $dayName = $day['day_string'];

            $forecastForParameter = $day[$parameterName];

            $dayData = [
                'forecast_from' => $minDate,
                'forecast_to' => $maxDate,
                'day' => $dayName,
                'parameters' => [
                    $parameterName => $this->formatForecastValues(collect($forecastForParameter)),
                ]
            ];

            if ($parameterName == self::PARAMETER_TEMPERATURE) {
                $dayData['parameters']['temperature_variance'] = $this->formatForecastValues(collect($day[self::PARAMETER_TEMPERATURE_VARIANCE]), true);
            } else if ($parameterName == self::PARAMETER_RAINFALL) {
                $dayData['parameters']['rainfall_variance'] = $this->formatForecastValues(collect($day[self::PARAMETER_RAINFALL_VARIANCE]), true);
            }

            return $dayData;
        });

        return $days;
    }

    private function formatForecastValues(Collection $values, $variance = false)
    {
        return $values->map(function ($value) use ($variance) {
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