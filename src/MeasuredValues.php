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
    /**
     * Returns the measured temperatures of the last 24 hours in ten minute steps
     *
     * @param $stationId
     * @param string $lang
     * @return array
     */
    public function getTemperatureLast24Hours($stationId, $lang = 'en')
    {
        $parameterName = 'temperature';
        $version = $this->getParameterVersion('homepage', 'home.html');

        $stationData = $this->getStationDataWithVersion($version, 'homepage', $stationId, $lang);
        $stationMetadata = $this->getStationByParameter($parameterName, $stationId);

        $values = $stationData[0][$parameterName];
        $parameterData = $this->formatParameterValues($values, $parameterName);

        $data = $this->formatData($stationId, $stationData, $stationMetadata, $parameterName, $parameterData);

        return $data;
    }

    /**
     *
     *
     * @param $stationId
     * @param string $lang
     * @return array
     */
    public function getTemperature($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_TEMPERATURE;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getSunshinePerHour($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SUNSHINE;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getSunshinePerDay($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SUNSHINE;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getPrecipitationPerHour($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRECIPITATION;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getPrecipitationPerDay($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRECIPITATION_YEAR;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getWindCombination($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_COMBINATION;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getWindSpeed($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_SPEED;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getWindDirection($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_WIND_DIRECTION;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getAirPressure($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QFE;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getAirPressureSeaLevel($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QFF;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getAirPressureStandardAtmosphere($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_PRESSURE_QNH;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getHumidity($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_HUMIDITY;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getSnow($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SNOW_TOTAL;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getSnowNew($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_SNOW_NEW;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
    }

    public function getFoehn($stationId, $lang = 'en')
    {
        $parameterName = self::PARAMETER_FOEHN;

        $data = $this->getStationsParameterData($stationId, $lang, $parameterName);

        return $data;
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
        $url = 'product/output/measured-values/'.$parameterName.'/'.$version.'/'.$lang.'/overview.json';

        $stations = $this->makeRequest($url, true);

        return $stations['stations'];
    }

    /**
     * Returns all metadata for a station like elevation lat and longitude
     *
     * @param $parameterName
     * @param $stationId
     * @return mixed
     */
    public function getStationByParameter($parameterName, $stationId)
    {
        $stationsMetadata = $this->getStationsByParameter($parameterName);

        $stationMetadata = collect($stationsMetadata)->first(function ($stationMetadata) use ($stationId) {
            return $stationMetadata['id'] == $stationId;
        });

        return $stationMetadata;
    }

    /**
     * Fetches all version tags from frontend html page to access api endpoints
     */
    private function findSiteVersions($url = null)
    {
        if (!$url) {
            $url = 'home/wetter/messwerte/messwerte-an-stationen.html';
        }

        $html = $this->makeRequest($url);

        $regex = '/product\/output\/measured-values\/([a-z-]*)\/(version__[0-9]{6,8}_[0-9]{2,4})\/(de)/';
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
     * @param $parameterName
     * @param $url
     * @return mixed
     */
    private function getParameterVersion($parameterName, $url = null)
    {
        $versions = $this->findSiteVersions($url);
        $parameterVersion = $versions->first(function ($item) use ($parameterName) {
            return $item['parameter-name'] == $parameterName;
        });

        return $parameterVersion['version'];
    }

    private function getStationDataWithVersion($version, $parameterName, $stationId, $lang)
    {
        $url = 'product/output/measured-values/'.$parameterName.'/'.$version.'/'.$lang.'/'.$stationId.'.json';

        $stationData = $this->makeRequest($url, true);

        return $stationData;
    }

    private function getStationData($parameterName, $stationId, $lang)
    {
        $version = $this->getParameterVersion($parameterName);

        return $this->getStationDataWithVersion($version, $parameterName, $stationId, $lang);
    }

    /**
     * @param $stationId
     * @param $stationData
     * @param $stationMetadata
     * @param null $parameterName
     * @param null $parameterData
     * @return array
     */
    private function formatData($stationId, $stationData, $stationMetadata, $parameterName = null, $parameterData = null)
    {
        $parameters = [];
        if ($parameterName && $parameterData) {
            $parameters[] = $parameterData;
        } else {
            foreach ($stationData['series'] as $parameter) {
                $parameters[] = [
                    'label' => $parameter['name'],
                    'value_suffix' => $stationData['chart_options']['value_suffix'],
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
        }

        $data = $this->buildStationMetadata($stationId, $stationMetadata);

        $data['parameters'] = $parameters;

        return $data;
    }

    /**
     * @param $stationId
     * @param $lang
     * @param $parameterName
     * @return array
     */
    private function getStationsParameterData($stationId, $lang, $parameterName): array
    {
        $stationData = $this->getStationData($parameterName, $stationId, $lang);
        $stationMetadata = $this->getStationByParameter($parameterName, $stationId);
        $data = $this->formatData($stationId, $stationData, $stationMetadata);
        return $data;
    }

    /**
     * @param $stationId
     * @param $stationMetadata
     * @return array
     */
    private function buildStationMetadata($stationId, $stationMetadata): array
    {
        $x = $stationMetadata['coord_x'];
        $y = $stationMetadata['coord_y'];

        $latitude = CoordinateConverter::CHtoWGSlat($x, $y);
        $longitude = CoordinateConverter::CHtoWGSlong($x, $y);

        $data = [
            'meta' => [
                'station' => $stationId,
                'city_name' => $stationMetadata['city_name'],
                'evelation' => $stationMetadata['evelation'],
                'latitude' => $latitude,
                'longitude' => $longitude
            ],
        ];
        return $data;
    }
}