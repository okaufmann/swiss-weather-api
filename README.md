Wetterdaten API Schweiz
====================

**ACHTUNG**: Die Verwendung der Daten auf der Webseite http://www.meteoschweiz.admin.ch sind rechtlich geschützt! Sie dürfen nicht verbreitet werden und nur für den Eigengebrauch verwendet werden.

Auszug vom 07.06.2017 der Seite http://www.meteoschweiz.admin.ch/home/ueber-uns/kontakt/rechtliches.html.

## Copyright & Nutzungsrechte

>Copyright, Bundesamt für Meteorologie und Klimatologie MeteoSchweiz.

>Die auf den online-Medien (Website/APP) der MeteoSchweiz enthaltenen Informationen werden der Öffentlichkeit zugänglich gemacht. Die Dienstleistungen von MeteoSchweiz dürfen - mit Ausnahme der kleinen Warnkarte - _**nur für den Eigengebrauch genutzt werden, jegliche Weitergabe der Dienstleistungen an Dritte ist unzulässig**_. Durch das Herunterladen oder Kopieren von Inhalten, Bildern, Fotos oder anderen Dateien werden keinerlei Rechte bezüglich der Inhalte übertragen.>

>Die Urheber- und alle anderen Rechte an Inhalten, Bildern, Fotos oder anderen Dateien auf den online-Medien (Website/APP) der MeteoSchweiz gehören ausschliesslich dieser oder den speziell genannten Rechtsinhabern. Für die Reproduktion jeglicher Elemente ist die schriftliche Zustimmung der Urheberrechtsträger im voraus einzuholen.
>Es ist nicht erlaubt, Dienstleistungen der MeteoSchweiz online-Medien (Website/APP) in einer Form zu nutzen, die die MeteoSchweiz-IT-Infrastruktur beeinträchtigen, überlasten oder schädigen könnte oder andere Nutzer beim Besuch der MeteoSchweiz-online-Medien (Website/APP) behindert. _**Insbesondere ist es ausdrücklich verboten, Daten der MeteoSchweiz-Website per Webroboter oder anderen automatisierten Verfahren vom Web-Server herunter zu laden und/oder weiter zu verarbeiten.**_

## Version
Für jeden der Untenstehenden Parameter gibt es jeweils einen aktuellen Stand der Daten,
dieser ist jeweils in den URLs direkt enthalten, muss also nachgeführt werden.

Die Urls können mit einem jeweiligen Regex o.ä. auf der Startseite gefunden werden. Die APIs für einzelne Stationen benutzen jeweils denselben key. Der key kann z.B. so aussehen `version__20170607_1504`.

Startseite: http://www.meteoschweiz.admin.ch/home/wetter/messwerte/messwerte-an-stationen.html?param=foehn

## Parameter:
- Temperatur
- Sonnenschein
- Niederschlag
- Wind
- Luftdruck
- Luftfeuchtigkeit
- Schnee
- Föhn

## Temperatur
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/temperature/version__20170607_1504/de/overview.json`

```json
{
  "config": {
    "name": "temperature-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847894
  },
  "stations": [
    {
      "id": "TAE",
      "coord_x": 710515,
      "coord_y": 259821,
      "altitude": 539,
      "city_name": "Aadorf / Tänikon",
      "name": "Aadorf / Tänikon",
      "min_zoom": 5,
      "current_value": 16.1,
      "value_suffix": "°C",
      "evelation": 539,
      "date": 1496847000000
    },
}
```

## Sonnenschein
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/sunshine/version__20170607_1504/de/overview.json`

```json
{
  "config": {
    "name": "sunshine-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847890
  },
  "stations": [
    {
      "id": "TAE",
      "coord_x": 710515,
      "coord_y": 259821,
      "altitude": 539,
      "city_name": "Aadorf / Tänikon",
      "name": "Aadorf / Tänikon",
      "min_zoom": 5,
      "current_value": 10,
      "value_suffix": "min",
      "evelation": 539,
      "date": 1496847000000
    },
}
```

## Niederschlag

### Alle Stationen
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/precipitation/version__20170607_1459/de/overview.json`

```json
{
  "config": {
    "name": "precipitation-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847593
  },
  "stations": [
    {
      "id": "TAE",
      "coord_x": 710515,
      "coord_y": 259821,
      "altitude": 539,
      "city_name": "Aadorf / Tänikon",
      "name": "Aadorf / Tänikon",
      "min_zoom": 5,
      "current_value": 0,
      "value_suffix": "mm",
      "evelation": 539,
      "date": 1496847000000
    },
}
```

### Einzelne Station

Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/precipitation/version__20170607_1528/de/{STATION ID}.json`

```json
{
  "config": {
    "name": "precipitation-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496849332
  },
  "chart_options": {
    "id": "precipitation",
    "value_suffix": "mm",
    "margin_top": 60,
    "min_value": 0,
    "min_range": 1.9
  },
  "plotlines": [
    [
      1496613600000
    ],
    [
      1496700000000
    ],
    [
      1496786400000
    ]
  ],
  "series": [
    {
      "serie_id": 0,
      "name": "Niederschlag",
      "chart_options": {
        "type": "column",
        "value_suffix": "mm",
        "color": "#AFDDF5"
      },
      "data": [
        [
          1496534400000,
          2.2
        ],
```

## Wind

Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/wind-combination/version__20170607_1503/de/overview.json`

```json
{
  "config": {
    "name": "wind-combination-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847807
  },
  "stations": [
    {
      "id": "TAE",
      "coord_x": 710515,
      "coord_y": 259821,
      "altitude": 539,
      "city_name": "Aadorf / Tänikon",
      "name": "Aadorf / Tänikon",
      "min_zoom": 5,
      "current_value": [
        15.8,
        31.3,
        283
      ],
      "value_suffix": "°",
      "evelation": 539,
      "date": 1496847000000
    },
}

```

## Luftdruck
**TODO**

## Luftfeutchtigkeit
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/humidity/version__20170607_1504/de/overview.json`

```json
{
  "config": {
    "name": "precipitation-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847593
  },
  "stations": [
    {
      "id": "TAE",
      "coord_x": 710515,
      "coord_y": 259821,
      "altitude": 539,
      "city_name": "Aadorf / Tänikon",
      "name": "Aadorf / Tänikon",
      "min_zoom": 5,
      "current_value": 0,
      "value_suffix": "mm",
      "evelation": 539,
      "date": 1496847000000
    },
```

## Schnee Total
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/snow-total/version__20170607_1154/de/overview.json`

```json
{
  "config": {
    "name": "snow-total-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496836452
  },
  "stations": [
    {
      "id": "ABE",
      "coord_x": 588051,
      "coord_y": 209518,
      "altitude": 493,
      "city_name": "Aarberg",
      "name": "Aarberg",
      "min_zoom": 5,
      "current_value": 0,
      "value_suffix": "cm",
      "evelation": 493,
      "date": 1496786400000
    },
```

## Schnee Neu
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/snow-new/version__20170607_1154/de/overview.json`

```json
{
  "config": {
    "name": "snow-new-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496836450
  },
  "stations": [
    {
      "id": "ABE",
      "coord_x": 588051,
      "coord_y": 209518,
      "altitude": 493,
      "city_name": "Aarberg",
      "name": "Aarberg",
      "min_zoom": 5,
      "current_value": 0,
      "value_suffix": "cm",
      "evelation": 493,
      "date": 1496786400000
    },
```

## Föhn
Endpoint: `http://www.meteoschweiz.admin.ch/product/output/measured-values-v2/foehn/version__20170607_1459/de/overview.json`

```json
{
  "config": {
    "name": "foehn-measurement",
    "language": "de",
    "version": "1.0.0",
    "timestamp": 1496847594
  },
  "stations": [
    {
      "id": "COM",
      "coord_x": 714998,
      "coord_y": 146440,
      "altitude": 575,
      "city_name": "Acquarossa / Comprovasco",
      "name": "Acquarossa / Comprovasco",
      "min_zoom": 6,
      "current_value": 2,
      "value_suffix": " ",
      "evelation": 575,
      "date": 1496846400000
    },
```
