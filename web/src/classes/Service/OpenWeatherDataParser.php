<?php
namespace M151\Service;

use M151\Model\WeatherInfo;

class OpenWeatherDataParser
{
    public function parse($data)
    {
        return $this->parseJSON($data);
    }

    protected function parseJSON($data)
    {

        $result = new WeatherInfo();
        $result->temp = $data->main->temp;
        $result->pressure = $data->main->pressure;
        $result->location = (string) $data->name;
        $result->humidity = $data->main->humidity;
        $result->description = $data->weather[0]->description;
        $result->timestamp = strftime('%d.%m.%Y %H:%M', $data->dt);
        $result->icon = "http://openweathermap.org/img/w/" . (string) $data->weather[0]->icon . ".png";

        return $result;
    }
}