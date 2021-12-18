<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\Service\OpenWeatherDataParser;

class WeatherController extends Controller
{
    public function getWeather(Request $req)
    {
        //$zipCode = $req->getParams()[0]->zip;
        foreach($req->getParams() as $key=>$value) {
            //echo "Param: {$key} => {$value}\n";
            $zipCode = $value;
        }
        // var_dump($zipCode);
        // var_dump($req->getParams());
        //$zipCode = '8400';
        $data = $this->fetchData($zipCode);

        echo <<<EOT
        <!DOCTYPE html>
        <html>
        <head><title>Wetter</title></head>
        <style>
            html, body {
                font-family: Helvetica, sans-serif;
            }
        </style>
        <body>
        <h1>Wetter vom {$data->timestamp} in {$zipCode} {$data->location}</h1>
        <div style="display:flex">
        <img src="{$data->icon}" />
        <p>
     Es ist {$data->description}, bei {$data->temp}°C, {$data->humidity}% Luftfeuchtigkeit und {$data->pressure}hPa Luftdruck.
        </p>
        </div>
        </body>
        </html>
EOT;
    }

    protected function fetchData($zipCode)
    {
        $zip = (isset($zipCode)) ? $zipCode : "8500";
        //var_dump($zip);
        $data = $this->readJSONData( '20915fef33b0fb948cf25547fa3d5da6', $zip, 'ch');
        $parser = new OpenWeatherDataParser();
        $res = $parser->parse($data);
        return $res;
    }
    public function test() {
        header('Content-Type: text/plain');
        $zip = '8442';
        $country = 'ch';
        $apiKey = '20915fef33b0fb948cf25547fa3d5da6';
        $data = $this->readJSONData($apiKey, $zip, $country);

        print_r($data);

        print_r(($data->weather[0]->description));
    }

    protected function readJSONData($apiKey, $zip, $country)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?lang=de&units=metric&zip={$zip},{$country}&appid={$apiKey}";
        //var_dump($url);
        $response = file_get_contents($url);

        $obj = json_decode($response);

        return $obj;
    }

}