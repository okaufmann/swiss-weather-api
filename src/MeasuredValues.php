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

trait MeasuredValues
{

    public function __construct()
    {
        $this->setupClient();
    }

    public function getTemperature($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_TEMPERATURE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSunshinePerHour($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SUNSHINE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSunshinePerDay($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SUNSHINE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getPrecipitationPerHour($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRECIPITATION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getPrecipitationPerDay($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRECIPITATION_YEAR;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindCombination($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_COMBINATION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindSpeed($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_SPEED;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getWindDirection($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_DIRECTION;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressure($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QFE;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressureSeaLevel($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QFF;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getAirPressureStandardAtmosphere($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QNH;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getHumidity($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_HUMIDITY;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSnow($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SNOW_TOTAL;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getSnowNew($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SNOW_NEW;
        $version = $this->getParameterVersion($parameterName);
        $station = $this->getStation($version, $parameterName, $stationId, $lang);

        return $station;
    }

    public function getFoehn($stationId, $lang = 'en')
    {
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

        $stations = $this->makeRequest($url, true);

        return $stations['stations'];
    }

    /**
     * Fetches all version tags from frontend html page to access api endpoints
     */
    private function getParametersAndVersions()
    {
        $url = 'home/wetter/messwerte/messwerte-an-stationen.html';
        $html = $this->makeRequest($url);

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

        $parameterVersions = $versions;

        return collect($parameterVersions);
    }

    /**
     * Ger version tag for specific parameter.
     *
     * @param $parameeterName
     * @return mixed
     */
    private function getParameterVersion($parameeterName)
    {
        $versions = $this->getParametersAndVersions();
        $parameterVersion = $versions->first(function ($item) use ($parameeterName) {
            return $item['parameter-name'] == $parameeterName;
        });

        return $parameterVersion['version'];
    }

    private function getStation($version, $parameterName, $stationId, $lang)
    {
        $url = 'product/output/measured-values-v2/'.$parameterName.'/'.$version.'/'.$lang.'/'.$stationId.'.json';

        $station = $this->makeRequest($url, true);

        $stationsMetadata = $this->getStationsByParameter($parameterName);
        $stationMetadata = collect($stationsMetadata)->first(function ($stationMetadata) use ($stationId) {
            return $stationMetadata['id'] == $stationId;
        });

        $data = $this->formatData($stationId, $station, $stationMetadata);

        return $data;
    }

    /**
     * @param $stationId
     * @param $station
     * @return array
     */
    private function formatData($stationId, $station, $stationMetadata)
    {
        $parameters = [];
        foreach ($station['series'] as $parameter) {
            $parameters[] = [
                'label' => $parameter['name'],
                'value_suffix' => $station['chart_options']['value_suffix'],
                'data' => collect($parameter['data'])
                    ->map(function ($dataItem) {
                        return [
                            'datetime' => $this->getUtcDate($dataItem[0]),
                            'value' => $dataItem[1]
                        ];
                    })
                    ->toArray(),
            ];
        }

        // $stationMetadata = [▼
        //   "id" => "INT"
        //   "coord_x" => 633019
        //   "coord_y" => 169093
        //   "city_name" => "Interlaken"
        //   "min_zoom" => 4
        //   "current_value" => -0.9
        //   "value_suffix" => "°C"
        //   "evelation" => 577
        //   "date" => 1510690800000.0
        // ]

        $x = $stationMetadata['coord_x'];
        $y = $stationMetadata['coord_y'];

        $latitude = CoordinateConverter::CHtoWGSlat($x, $y);
        $longitude = CoordinateConverter::CHtoWGSlong($x, $y);

        $data = [
            'meta' => [
                'value_suffix' => $station['chart_options']['value_suffix'],
                'timestamp' => $this->getUtcDate($station['config']['timestamp']),
                'language' => $station['config']['language'],
                'station' => $stationId,
                'city_name' => $stationMetadata['city_name'],
                'evelation' => $stationMetadata['evelation'],
                'latitude' => $latitude,
                'longitude' => $longitude
            ],
            'parameters' => $parameters
        ];

        return $data;
    }
}