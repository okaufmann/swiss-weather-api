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


abstract class ClientAbstract
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

    /** forecast only */
    const PARAMETER_RAINFALL = 'rainfall';
    const PARAMETER_RAINFALL_VARIANCE = 'variance_range';
    const PARAMETER_TEMPERATURE_VARIANCE = 'variance_rain';
    const PARAMETER_WIND = 'wind';


    const PARAMETERS = [
        self::PARAMETER_TEMPERATURE,
        self::PARAMETER_TEMPERATURE_YEAR,
        self::PARAMETER_WIND_COMBINATION,
        self::PARAMETER_SNOW_TOTAL,
        self::PARAMETER_SUNSHINE,
        self::PARAMETER_SUNSHINE_YEAR,
        self::PARAMETER_PRESSURE_QFE,
        self::PARAMETER_FOEHN,
        self::PARAMETER_PRECIPITATION,
        self::PARAMETER_PRECIPITATION_YEAR,
        self::PARAMETER_HUMIDITY,
        self::PARAMETER_WIND_SPEED,
        self::PARAMETER_WIND_DIRECTION,
        self::PARAMETER_PRESSURE_QFF,
        self::PARAMETER_PRESSURE_QNH,
        self::PARAMETER_SNOW_NEW,
    ];

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

    const STATIONS = [
        self::STATION_ACQUAROSSA_COMPROVASCO,
        self::STATION_ADELBODEN,
        self::STATION_AFFOLTERN_IE,
        self::STATION_AIGLE,
        self::STATION_AIROLO,
        self::STATION_ALTDORF,
        self::STATION_ALTENRHEIN,
        self::STATION_ALTSTAETTEN_SG,
        self::STATION_AMRISWIL,
        self::STATION_ANDEER,
        self::STATION_ANDERMATT,
        self::STATION_ANZERE,
        self::STATION_APPENZELL,
        self::STATION_AROLLA,
        self::STATION_AROSA,
        self::STATION_ATTELWIL,
        self::STATION_BAD_RAGAZ,
        self::STATION_BALTSCHIEDERTAL,
        self::STATION_BARRAGE_GRANDE_DIXENCE,
        self::STATION_BASEL_BINNINGEN,
        self::STATION_BELLELAY,
        self::STATION_BELLINZONA,
        self::STATION_BENKEN_DOGGEN,
        self::STATION_BERGUEN_LATSCH,
        self::STATION_BERN_ZOLLIKOFEN,
        self::STATION_BERNINA_CURTINATSCH,
        self::STATION_BEX,
        self::STATION_BEZNAU,
        self::STATION_BIASCA,
        self::STATION_BIERE,
        self::STATION_BINN,
        self::STATION_BISCHOFSZELL,
        self::STATION_BIVIO,
        self::STATION_BLATTEN_LOETSCHENTAL,
        self::STATION_BLINNEN,
        self::STATION_BOEZBERG,
        self::STATION_BOLTIGEN,
        self::STATION_BOSCO_GURIN,
        self::STATION_BOURG_ST_PIERRE,
        self::STATION_BOUVERET,
        self::STATION_BRAUNWALD,
        self::STATION_BRICOLA,
        self::STATION_BRIENZ,
        self::STATION_BRIG,
        self::STATION_BRISTEN,
        self::STATION_BRUCHJI,
        self::STATION_BRUSIO,
        self::STATION_BUCHS_AARAU,
        self::STATION_BUFFALORA,
        self::STATION_BULLET_LA_FRETAZ,
        self::STATION_CEVIO,
        self::STATION_CHAM,
        self::STATION_CHAMPERY,
        self::STATION_CHASSERAL,
        self::STATION_CHATEAU_D_OEX,
        self::STATION_CHAUMONT,
        self::STATION_CHOEX,
        self::STATION_CHUR,
        self::STATION_CIMETTA,
        self::STATION_CLUSANFE,
        self::STATION_COL_DES_MOSSES,
        self::STATION_COL_DU_GRAND_ST_BERNARD,
        self::STATION_COLDRERIO,
        self::STATION_COSSONAY,
        self::STATION_COURTELARY,
        self::STATION_COUVET,
        self::STATION_CRAP_MASEGN,
        self::STATION_CRESSIER,
        self::STATION_DAVOS,
        self::STATION_DELEMONT,
        self::STATION_DERBORENCE,
        self::STATION_DIETIKON,
        self::STATION_DISENTIS,
        self::STATION_DURNAND,
        self::STATION_EBNAT_KAPPEL,
        self::STATION_EGGISHORN,
        self::STATION_EGOLZWIL,
        self::STATION_EHRENDINGEN,
        self::STATION_EINSIEDELN,
        self::STATION_ELM,
        self::STATION_EMOSSON,
        self::STATION_ENGELBERG,
        self::STATION_ENTLEBUCH,
        self::STATION_ERGISCH,
        self::STATION_ESCHENZ,
        self::STATION_EVIONNAZ,
        self::STATION_EVOLENE_VILLA,
        self::STATION_FAHY,
        self::STATION_FAIDO,
        self::STATION_FIESCHERTAL,
        self::STATION_FINDELEN,
        self::STATION_FIONNAY,
        self::STATION_FLAWIL,
        self::STATION_FLUEHLI_LU,
        self::STATION_FRIBOURG_POSIEUX,
        self::STATION_FRUTIGEN,
        self::STATION_GENEVE_COINTRIN,
        self::STATION_GERSAU,
        self::STATION_GISWIL,
        self::STATION_GLARUS,
        self::STATION_GOESCHENEN,
        self::STATION_GOESCHENERALP,
        self::STATION_GOESGEN,
        self::STATION_GORNERGRAT,
        self::STATION_GRAECHEN,
        self::STATION_GRENCHEN,
        self::STATION_GRIMSEL_HOSPIZ,
        self::STATION_GRONO,
        self::STATION_GSTEIG_GSTAAD,
        self::STATION_GUETSCH_ANDERMATT,
        self::STATION_GUETTINGEN,
        self::STATION_GUTTANNEN,
        self::STATION_HALLAU,
        self::STATION_HOERNLI,
        self::STATION_HUTTWIL,
        self::STATION_ILANZ,
        self::STATION_INNERTHAL,
        self::STATION_INTERLAKEN,
        self::STATION_ISERABLES,
        self::STATION_JEIZINEN,
        self::STATION_JONA,
        self::STATION_JUNGFRAUJOCH,
        self::STATION_KANDERSTEG,
        self::STATION_KLOSTERS,
        self::STATION_KOPPIGEN,
        self::STATION_L_AUBERSON,
        self::STATION_LA_BREVINE,
        self::STATION_LA_CHAUX_DE_FONDS,
        self::STATION_LA_DOLE,
        self::STATION_LA_FOULY,
        self::STATION_LACHEN_GALGENEN,
        self::STATION_LAEGERN,
        self::STATION_LANGENBRUCK,
        self::STATION_LANGNAU_IE,
        self::STATION_LAUSANNE,
        self::STATION_LAUTERBRUNNEN,
        self::STATION_LE_MOLESON,
        self::STATION_LEIBSTADT,
        self::STATION_LES_ATTELAS,
        self::STATION_LES_AVANTS,
        self::STATION_LES_CHARBONNIERES,
        self::STATION_LES_COLLONS,
        self::STATION_LES_DIABLERETS,
        self::STATION_LES_MARECOTTES,
        self::STATION_LEUKERBAD,
        self::STATION_LOCARNO_MONTI,
        self::STATION_LOHN_SH,
        self::STATION_LONGIROD,
        self::STATION_LUGANO,
        self::STATION_LUZERN,
        self::STATION_MAGADINO_CADENAZZO,
        self::STATION_MAGGLINGEN,
        self::STATION_MALBUN,
        self::STATION_MARSENS,
        self::STATION_MARTIGNY,
        self::STATION_MARTINA,
        self::STATION_MATHOD,
        self::STATION_MATRO,
        self::STATION_MATTSAND,
        self::STATION_MEIRINGEN,
        self::STATION_MERVELIER,
        self::STATION_MOEHLIN,
        self::STATION_MOIRY,
        self::STATION_MONTAGNIER_BAGNES,
        self::STATION_MONTANA,
        self::STATION_MONTE_GENEROSO,
        self::STATION_MONTE_ROSA_PLATTJE,
        self::STATION_MORMONT,
        self::STATION_MOSEN,
        self::STATION_MOSOGNO,
        self::STATION_MOTTEC,
        self::STATION_MUEHLEBERG,
        self::STATION_MURI_AG,
        self::STATION_NALUNS_SCHLIVERA,
        self::STATION_NAPF,
        self::STATION_NENDAZ,
        self::STATION_NESSELBODEN,
        self::STATION_NEUCHATEL,
        self::STATION_NYON_CHANGINS,
        self::STATION_OBERAEGERI,
        self::STATION_OBERIBERG,
        self::STATION_OBERRIET_KRIESSERN,
        self::STATION_OPFIKON,
        self::STATION_ORON,
        self::STATION_ORSIERES,
        self::STATION_OTEMMA,
        self::STATION_PASSO_DEL_BERNINA,
        self::STATION_PAYERNE,
        self::STATION_PILATUS,
        self::STATION_PIOTTA,
        self::STATION_PIZ_CORVATSCH,
        self::STATION_PIZ_MARTEGNAS,
        self::STATION_PLAFFEIEN,
        self::STATION_POSCHIAVO_ROBBIA,
        self::STATION_PULLY,
        self::STATION_QUINTEN,
        self::STATION_REMPEN,
        self::STATION_RIEDHOLZ_WALLIERHOF,
        self::STATION_ROBIEI,
        self::STATION_ROMONT,
        self::STATION_ROSSBERG,
        self::STATION_ROTHENBRUNNEN,
        self::STATION_RUENENBERG,
        self::STATION_S_BERNARDINO,
        self::STATION_SAAS_BALEN,
        self::STATION_SAENTIS,
        self::STATION_SAFIEN_PLATZ,
        self::STATION_SAIGNELEGIER,
        self::STATION_SALANFE,
        self::STATION_SALEINA,
        self::STATION_SALEN_REUTENEN,
        self::STATION_SALEZ_SAXERRIET,
        self::STATION_SAMEDAN,
        self::STATION_SATTEL_SZ,
        self::STATION_SAVOGNIN,
        self::STATION_SCHAAN,
        self::STATION_SCHAFFHAUSEN,
        self::STATION_SCHIERS,
        self::STATION_SCHMERIKON,
        self::STATION_SCHUEPFHEIM,
        self::STATION_SCUOL,
        self::STATION_SEGL_MARIA,
        self::STATION_SIEBNEN,
        self::STATION_SIERRE,
        self::STATION_SIHLBRUGG,
        self::STATION_SIMPLON_DORF,
        self::STATION_SION,
        self::STATION_SOGLIO,
        self::STATION_SORNIOT_LAC_INFERIEUR,
        self::STATION_ST_ANTOENIEN,
        self::STATION_ST_GALLEN,
        self::STATION_ST_PREX,
        self::STATION_STA_MARIA_VAL_MUESTAIR,
        self::STATION_STABIO,
        self::STATION_STAFEL,
        self::STATION_STARKENBACH,
        self::STATION_STECKBORN,
        self::STATION_STETTEN,
        self::STATION_STOECKALP,
        self::STATION_SUSCH,
        self::STATION_THUN,
        self::STATION_THUSIS,
        self::STATION_TITLIS,
        self::STATION_TORRICELLA_CRANA,
        self::STATION_TRIENT,
        self::STATION_TRUN,
        self::STATION_TSANFLEURON,
        self::STATION_TSCHIERTSCHEN,
        self::STATION_TURTMANN,
        self::STATION_ULRICHEN,
        self::STATION_UNTERKULM,
        self::STATION_URNAESCH,
        self::STATION_VADUZ,
        self::STATION_VAETTIS,
        self::STATION_VALBELLA,
        self::STATION_VALS,
        self::STATION_VERCORIN,
        self::STATION_VEVEY_CORSEAUX,
        self::STATION_VICOSOPRANO,
        self::STATION_VILLARS_TIERCELIN,
        self::STATION_VISP,
        self::STATION_VISPERTERMINEN,
        self::STATION_VRIN,
        self::STATION_WAEDENSWIL,
        self::STATION_WARTAU,
        self::STATION_WEESEN,
        self::STATION_WEISSFLUHJOCH,
        self::STATION_WINTERTHUR_SEEN,
        self::STATION_WITTNAU,
        self::STATION_WUERENLINGEN_PSI,
        self::STATION_WYNAU,
        self::STATION_ZERMATT,
        self::STATION_ZERVREILA,
        self::STATION_ZUERICH_AFFOLTERN,
        self::STATION_ZUERICH_FLUNTERN,
        self::STATION_ZUERICH_KLOTEN,
        self::STATION_ZWILLIKON,
    ];
}