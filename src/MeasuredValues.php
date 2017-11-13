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

trait MeasuredValues
{

    /**
     * @var array
     */
    public $parameterVersionsMeasuredValues;

    public function __construct()
    {
        $this->setupClient();
    }

    public function getTemperature($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_TEMPERATURE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSunshinePerHour($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_SUNSHINE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSunshinePerDay($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_SUNSHINE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getPrecipitationPerHour($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_PRECIPITATION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getPrecipitationPerDay($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_PRECIPITATION_YEAR;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindCombination($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_WIND_COMBINATION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindSpeed($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_WIND_SPEED;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindDirection($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_WIND_DIRECTION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressure($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_PRESSURE_QFE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressureSeaLevel($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_PRESSURE_QFF;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressureStandardAtmosphere($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_PRESSURE_QNH;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getHumidity($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_HUMIDITY;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSnow($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_SNOW_TOTAL;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSnowNew($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_SNOW_NEW;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getFoehn($stationId, $lang = 'en')
    {
        $this->getParametersAndVersions();
        $parameterName = self::PARAMETER_FOEHN;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    /**
     * Returns all stations by a specific station.
     *
     * @param $parameterName
     * @param string $lang
     * @return mixed
     */
    public function getStationsByParameter($parameterName, $lang = 'en')
    {
        $version = $this->getParameterVersion($parameterName);
        $url = 'product/output/measured-values-v2/'.$parameterName.'/'.$version.'/'.$lang.'/overview.json';

        $stations = cache('stations.'.$parameterName, function () use ($lang, $url) {
            $response = $this->client->get($url);
            $html = (string)$response->getBody();
            return json_decode($html, true);
        });

        return $stations['stations'];
    }

    /**
     * Fetches all version tags from frontend html page to access api endpoints
     */
    private function getParametersAndVersions()
    {
        if (!$this->parameterVersionsMeasuredValues) {

            $parameterVersions = cache('parameters', function () {

                $url = 'home/wetter/messwerte/messwerte-an-stationen.html';
                $response = $this->client->get($url);
                $html = (string)$response->getBody();

                $regex = '/product\/output\/measured-values-v2\/([a-z-]*)\/(version__[0-9]{6,8}_[0-9]{2,4})\/(de)/';
                $matches = Regex::matchAll($regex, $html);

                $versions = collect($matches->results())
                    ->map(function (MatchResult $match) {
                        return [
                            'parameter-name' => $match->group(1),
                            'version' => $match->group(2),
                            'lang' => $match->group(3)
                        ];
                    })
                    ->unique('parameter-name');

                return $versions;
            });

            $this->parameterVersionsMeasuredValues = collect($parameterVersions);
        }

        return $this->parameterVersionsMeasuredValues;
    }

    /**
     * Ger version tag for specific parameter.
     *
     * @param $parameeterName
     * @return mixed
     */
    private function getParameterVersion($parameeterName)
    {
        if (!$this->parameterVersionsMeasuredValues) {
            $this->getParametersAndVersions();
        }

        $parameterVersion = $this->parameterVersionsMeasuredValues->first(function ($item) use ($parameeterName) {
            return $item['parameter-name'] == $parameeterName;
        });

        return $parameterVersion['version'];
    }

    private function getStation($version, $parameterName, $stationId, $lang)
    {
        $url = 'product/output/measured-values-v2/'.$parameterName.'/'.$version.'/'.$lang.'/'.$stationId.'.json';

        $station = cache('station.'.$parameterName, function () use ($lang, $url) {
            $response = $this->client->get($url);
            $html = (string)$response->getBody();
            return json_decode($html, true);
        });

        $data = $this->formatData($stationId, $station);

        return $data;
    }
}