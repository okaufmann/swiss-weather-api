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

class Client
{
    const PARAMETER_TEMPERATURE = 'temperature';
    const PARAMETER_TEMPERATURE_YEAR = 'temperature-year';
    const PARAMETER_WIND_COMBINATION = 'wind-combination';
    const PARAMETER_SNOW_TOTAL = 'snow-total';
    const PARAMETER_SUNSHINE = 'sunshine';
    const PARAMETER_SUNSHINE_YEAR = 'sunshine-year';
    const PARAMETER_PRESSURE_QFE = 'pressure-qfe';
    const PARAMETER_FOEHN = 'foehn';
    const PARAMETER_PRECIPITATION = 'precipitation';
    const PARAMETER_PRECIPITATION_YEAR = 'precipitation-year';
    const PARAMETER_HUMIDITY = 'humidity';
    const PARAMETER_WIND_SPEED = 'wind-speed';
    const PARAMETER_WIND_DIRECTION = 'wind-direction';
    const PARAMETER_PRESSURE_QFF = 'pressure-qff';
    const PARAMETER_PRESSURE_QNH = 'pressure-qnh';
    const PARAMETER_SNOW_NEW = 'snow-new';

    const STATION_AADORF_TAENIKON = 'TAE';
    const STATION_ACQUAROSSA_COMPROVASCO = 'COM';
    const STATION_ADELBODEN = 'ABO';
    const STATION_AFFOLTERN_IE = 'AIE';
    const STATION_AIGLE = 'AIG';
    const STATION_AIROLO = 'AIR';
    const STATION_ALTDORF = 'ALT';
    const STATION_ALTENRHEIN = 'ARH';
    const STATION_ALTSTAETTEN_SG = 'ALS';
    const STATION_AMRISWIL = 'AMW';
    const STATION_ANDEER = 'AND';
    const STATION_ANDERMATT = 'ANT';
    const STATION_ANZERE = 'VSANZ';
    const STATION_APPENZELL = 'APP';
    const STATION_AROLLA = 'VSARO';
    const STATION_AROSA = 'ARO';
    const STATION_ATTELWIL = 'AGATT';
    const STATION_BAD_RAGAZ = 'RAG';
    const STATION_BALTSCHIEDERTAL = 'VSBAS';
    const STATION_BARRAGE_GRANDE_DIXENCE = 'VSGDX';
    const STATION_BASEL_BINNINGEN = 'BAS';
    const STATION_BELLELAY = 'BEY';
    const STATION_BELLINZONA = 'BLZ';
    const STATION_BENKEN_DOGGEN = 'DOB';
    const STATION_BERGUEN_LATSCH = 'LAT';
    const STATION_BERN_ZOLLIKOFEN = 'BER';
    const STATION_BERNINA_CURTINATSCH = 'BEC';
    const STATION_BEX = 'BEX';
    const STATION_BEZNAU = 'BEZ';
    const STATION_BIASCA = 'BIA';
    const STATION_BIERE = 'BIE';
    const STATION_BINN = 'BIN';
    const STATION_BISCHOFSZELL = 'BIZ';
    const STATION_BIVIO = 'BIV';
    const STATION_BLATTEN_LOETSCHENTAL = 'BLA';
    const STATION_BLINNEN = 'VSBLI';
    const STATION_BOEZBERG = 'UBB';
    const STATION_BOLTIGEN = 'BOL';
    const STATION_BOSCO_GURIN = 'BOS';
    const STATION_BOURG_ST_PIERRE = 'VSBSP';
    const STATION_BOUVERET = 'BOU';
    const STATION_BRAUNWALD = 'BRW';
    const STATION_BRICOLA = 'VSBRI';
    const STATION_BRIENZ = 'BRZ';
    const STATION_BRIG = 'BRI';
    const STATION_BRISTEN = 'BRT';
    const STATION_BRUCHJI = 'VSBRU';
    const STATION_BRUSIO = 'BRP';
    const STATION_BUCHS_AARAU = 'BUS';
    const STATION_BUFFALORA = 'BUF';
    const STATION_BULLET_LA_FRETAZ = 'FRE';
    const STATION_CEVIO = 'CEV';
    const STATION_CHAM = 'CHZ';
    const STATION_CHAMPERY = 'VSCHY';
    const STATION_CHASSERAL = 'CHA';
    const STATION_CHATEAU_D_OEX = 'CHD';
    const STATION_CHAUMONT = 'CHM';
    const STATION_CHOEX = 'VSCHO';
    const STATION_CHUR = 'CHU';
    const STATION_CIMETTA = 'CIM';
    const STATION_CLUSANFE = 'VSCLU';
    const STATION_COL_DES_MOSSES = 'CDM';
    const STATION_COL_DU_GRAND_ST_BERNARD = 'GSB';
    const STATION_COLDRERIO = 'COL';
    const STATION_COSSONAY = 'COS';
    const STATION_COURTELARY = 'COY';
    const STATION_COUVET = 'COU';
    const STATION_CRAP_MASEGN = 'CMA';
    const STATION_CRESSIER = 'CRM';
    const STATION_DAVOS = 'DAV';
    const STATION_DELEMONT = 'DEM';
    const STATION_DERBORENCE = 'VSDER';
    const STATION_DIETIKON = 'DIT';
    const STATION_DISENTIS = 'DIS';
    const STATION_DURNAND = 'VSDUR';
    const STATION_EBNAT_KAPPEL = 'EBK';
    const STATION_EGGISHORN = 'EGH';
    const STATION_EGOLZWIL = 'EGO';
    const STATION_EHRENDINGEN = 'OED';
    const STATION_EINSIEDELN = 'EIN';
    const STATION_ELM = 'ELM';
    const STATION_EMOSSON = 'VSEMO';
    const STATION_ENGELBERG = 'ENG';
    const STATION_ENTLEBUCH = 'ENT';
    const STATION_ERGISCH = 'VSERG';
    const STATION_ESCHENZ = 'ESZ';
    const STATION_EVIONNAZ = 'EVI';
    const STATION_EVOLENE_VILLA = 'EVO';
    const STATION_FAHY = 'FAH';
    const STATION_FAIDO = 'FAI';
    const STATION_FIESCHERTAL = 'FIT';
    const STATION_FINDELEN = 'VSFIN';
    const STATION_FIONNAY = 'FIO';
    const STATION_FLAWIL = 'FLW';
    const STATION_FLUEHLI_LU = 'FLU';
    const STATION_FRIBOURG_POSIEUX = 'GRA';
    const STATION_FRUTIGEN = 'FRU';
    const STATION_GENEVE_COINTRIN = 'GVE';
    const STATION_GERSAU = 'GES';
    const STATION_GISWIL = 'GIH';
    const STATION_GLARUS = 'GLA';
    const STATION_GOESCHENEN = 'GOS';
    const STATION_GOESCHENERALP = 'GOA';
    const STATION_GOESGEN = 'GOE';
    const STATION_GORNERGRAT = 'GOR';
    const STATION_GRAECHEN = 'GRC';
    const STATION_GRENCHEN = 'GRE';
    const STATION_GRIMSEL_HOSPIZ = 'GRH';
    const STATION_GRONO = 'GRO';
    const STATION_GSTEIG_GSTAAD = 'GSG';
    const STATION_GUETSCH_ANDERMATT = 'GUE';
    const STATION_GUETTINGEN = 'GUT';
    const STATION_GUTTANNEN = 'GTT';
    const STATION_HALLAU = 'HLL';
    const STATION_HOERNLI = 'HOE';
    const STATION_HUTTWIL = 'HUT';
    const STATION_ILANZ = 'ILZ';
    const STATION_INNERTHAL = 'INN';
    const STATION_INTERLAKEN = 'INT';
    const STATION_ISERABLES = 'VSISE';
    const STATION_JEIZINEN = 'VSJEI';
    const STATION_JONA = 'JON';
    const STATION_JUNGFRAUJOCH = 'JUN';
    const STATION_KANDERSTEG = 'KAS';
    const STATION_KLOSTERS = 'KLA';
    const STATION_KOPPIGEN = 'KOP';
    const STATION_L_AUBERSON = 'AUB';
    const STATION_LA_BREVINE = 'BRL';
    const STATION_LA_CHAUX_DE_FONDS = 'CDF';
    const STATION_LA_DOLE = 'DOL';
    const STATION_LA_FOULY = 'VSFLY';
    const STATION_LACHEN_GALGENEN = 'LAC';
    const STATION_LAEGERN = 'LAE';
    const STATION_LANGENBRUCK = 'LAB';
    const STATION_LANGNAU_IE = 'LAG';
    const STATION_LAUSANNE = 'LSN';
    const STATION_LAUTERBRUNNEN = 'LTB';
    const STATION_LE_MOLESON = 'MLS';
    const STATION_LEIBSTADT = 'LEI';
    const STATION_LES_ATTELAS = 'ATT';
    const STATION_LES_AVANTS = 'AVA';
    const STATION_LES_CHARBONNIERES = 'CHB';
    const STATION_LES_COLLONS = 'VSCOL';
    const STATION_LES_DIABLERETS = 'DIA';
    const STATION_LES_MARECOTTES = 'MAR';
    const STATION_LEUKERBAD = 'LEU';
    const STATION_LOCARNO_MONTI = 'OTL';
    const STATION_LOHN_SH = 'LOH';
    const STATION_LONGIROD = 'LON';
    const STATION_LUGANO = 'LUG';
    const STATION_LUZERN = 'LUZ';
    const STATION_MAGADINO_CADENAZZO = 'MAG';
    const STATION_MAGGLINGEN = 'MGL';
    const STATION_MALBUN = 'MAL';
    const STATION_MARSENS = 'MAS';
    const STATION_MARTIGNY = 'MAB';
    const STATION_MARTINA = 'MAT';
    const STATION_MATHOD = 'MAH';
    const STATION_MATRO = 'MTR';
    const STATION_MATTSAND = 'VSMAT';
    const STATION_MEIRINGEN = 'MER';
    const STATION_MERVELIER = 'MEV';
    const STATION_MOEHLIN = 'MOE';
    const STATION_MOIRY = 'VSMOI';
    const STATION_MONTAGNIER_BAGNES = 'MOB';
    const STATION_MONTANA = 'MVE';
    const STATION_MONTE_GENEROSO = 'GEN';
    const STATION_MONTE_ROSA_PLATTJE = 'MRP';
    const STATION_MORMONT = 'MMO';
    const STATION_MOSEN = 'MOA';
    const STATION_MOSOGNO = 'MSG';
    const STATION_MOTTEC = 'MTE';
    const STATION_MUEHLEBERG = 'MUB';
    const STATION_MURI_AG = 'MUR';
    const STATION_NALUNS_SCHLIVERA = 'NAS';
    const STATION_NAPF = 'NAP';
    const STATION_NENDAZ = 'VSNEN';
    const STATION_NESSELBODEN = 'NEB';
    const STATION_NEUCHATEL = 'NEU';
    const STATION_NYON_CHANGINS = 'CGI';
    const STATION_OBERAEGERI = 'AEG';
    const STATION_OBERIBERG = 'OBI';
    const STATION_OBERRIET_KRIESSERN = 'OBR';
    const STATION_OPFIKON = 'OPF';
    const STATION_ORON = 'ORO';
    const STATION_ORSIERES = 'ORS';
    const STATION_OTEMMA = 'VSOTE';
    const STATION_PASSO_DEL_BERNINA = 'BEH';
    const STATION_PAYERNE = 'PAY';
    const STATION_PILATUS = 'PIL';
    const STATION_PIOTTA = 'PIO';
    const STATION_PIZ_CORVATSCH = 'COV';
    const STATION_PIZ_MARTEGNAS = 'PMA';
    const STATION_PLAFFEIEN = 'PLF';
    const STATION_POSCHIAVO_ROBBIA = 'ROB';
    const STATION_PULLY = 'PUY';
    const STATION_QUINTEN = 'QUI';
    const STATION_REMPEN = 'REM';
    const STATION_RIEDHOLZ_WALLIERHOF = 'WHF';
    const STATION_ROBIEI = 'ROE';
    const STATION_ROMONT = 'ROM';
    const STATION_ROSSBERG = 'ROG';
    const STATION_ROTHENBRUNNEN = 'ROT';
    const STATION_RUENENBERG = 'RUE';
    const STATION_S_BERNARDINO = 'SBE';
    const STATION_SAAS_BALEN = 'VSSAB';
    const STATION_SAENTIS = 'SAE';
    const STATION_SAFIEN_PLATZ = 'SAP';
    const STATION_SAIGNELEGIER = 'SAI';
    const STATION_SALANFE = 'VSSFE';
    const STATION_SALEINA = 'VSSAL';
    const STATION_SALEN_REUTENEN = 'HAI';
    const STATION_SALEZ_SAXERRIET = 'SAX';
    const STATION_SAMEDAN = 'SAM';
    const STATION_SATTEL_SZ = 'SAG';
    const STATION_SAVOGNIN = 'SVG';
    const STATION_SCHAAN = 'SUA';
    const STATION_SCHAFFHAUSEN = 'SHA';
    const STATION_SCHIERS = 'SRS';
    const STATION_SCHMERIKON = 'SCM';
    const STATION_SCHUEPFHEIM = 'SPF';
    const STATION_SCUOL = 'SCU';
    const STATION_SEGL_MARIA = 'SIA';
    const STATION_SIEBNEN = 'SIE';
    const STATION_SIERRE = 'VSSIE';
    const STATION_SIHLBRUGG = 'SIH';
    const STATION_SIMPLON_DORF = 'SIM';
    const STATION_SION = 'SIO';
    const STATION_SOGLIO = 'SOG';
    const STATION_SORNIOT_LAC_INFERIEUR = 'VSSOR';
    const STATION_ST_ANTOENIEN = 'SAN';
    const STATION_ST_GALLEN = 'STG';
    const STATION_ST_PREX = 'PRE';
    const STATION_STA_MARIA_VAL_MUESTAIR = 'SMM';
    const STATION_STABIO = 'SBO';
    const STATION_STAFEL = 'VSSTA';
    const STATION_STARKENBACH = 'STB';
    const STATION_STECKBORN = 'STK';
    const STATION_STETTEN = 'AGSTE';
    const STATION_STOECKALP = 'STP';
    const STATION_SUSCH = 'SUS';
    const STATION_THUN = 'THU';
    const STATION_THUSIS = 'THS';
    const STATION_TITLIS = 'TIT';
    const STATION_TORRICELLA_CRANA = 'CTO';
    const STATION_TRIENT = 'VSTRI';
    const STATION_TRUN = 'TRU';
    const STATION_TSANFLEURON = 'VSTSN';
    const STATION_TSCHIERTSCHEN = 'TST';
    const STATION_TURTMANN = 'VSTUR';
    const STATION_ULRICHEN = 'ULR';
    const STATION_UNTERKULM = 'UNK';
    const STATION_URNAESCH = 'URN';
    const STATION_VADUZ = 'VAD';
    const STATION_VAETTIS = 'VAE';
    const STATION_VALBELLA = 'VAB';
    const STATION_VALS = 'VLS';
    const STATION_VERCORIN = 'VSVER';
    const STATION_VEVEY_CORSEAUX = 'VEV';
    const STATION_VICOSOPRANO = 'VIO';
    const STATION_VILLARS_TIERCELIN = 'VIT';
    const STATION_VISP = 'VIS';
    const STATION_VISPERTERMINEN = 'VSVIS';
    const STATION_VRIN = 'VRI';
    const STATION_WAEDENSWIL = 'WAE';
    const STATION_WARTAU = 'WAR';
    const STATION_WEESEN = 'WEE';
    const STATION_WEISSFLUHJOCH = 'WFJ';
    const STATION_WINTERTHUR_SEEN = 'WIN';
    const STATION_WITTNAU = 'WIT';
    const STATION_WUERENLINGEN_PSI = 'PSI';
    const STATION_WYNAU = 'WYN';
    const STATION_ZERMATT = 'ZER';
    const STATION_ZERVREILA = 'ZEV';
    const STATION_ZUERICH_AFFOLTERN = 'REH';
    const STATION_ZUERICH_FLUNTERN = 'SMA';
    const STATION_ZUERICH_KLOTEN = 'KLO';
    const STATION_ZWILLIKON = 'ZWK';

    /**
     * @var Http
     */
    public $client;

    /**
     * @var array
     */
    public $parameterVersions;

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

    public function getStations($parameterName, $version, $lang = 'en')
    {
        $url = 'product/output/measured-values-v2/'.$parameterName.'/'.$version.'/'.$lang.'/overview.json';

        $stations = cache('stations.'.$parameterName, function () use ($lang, $url) {
            $response = $this->client->get($url);
            $html = (string)$response->getBody();
            return json_decode($html, true);
        });

        return $stations['stations'];
    }

    public function getParametersAndVersions()
    {
        if (!$this->parameterVersions) {

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

            $this->parameterVersions = collect($parameterVersions);
        }

        return $this->parameterVersions;
    }

    private function getParameterVersion($parameeterName)
    {
        $parameterVersion = $this->parameterVersions->first(function ($item) use ($parameeterName) {
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