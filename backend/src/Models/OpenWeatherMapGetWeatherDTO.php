<?php


namespace App\Models;


use App\Entity\City;
use App\Entity\WeatherRecord;

class OpenWeatherMapGetWeatherDTO
{
    /**
     * @var OpenWeatherMapGetWeatherMainDTO
     */
    public $main;
    /**
     * @var integer
     */
    public $visibility;
    /**
     * @var OpenWeatherMapGetWeatherWindDTO
     */
    public $wind;

    public function toWeatherRecord(City $city)
    {
        $entity = new WeatherRecord();

        $entity->setCreatedAt(new \DateTime());
        $entity->setCity($city);
        $entity->setTemp($this->main->temp);
        $entity->setTempFeelsLike($this->main->feels_like);
        $entity->setPreesure($this->main->pressure);
        $entity->setHumidity($this->main->humidity);
        $entity->setVisibility($this->visibility);
        $entity->setWindSpeed($this->wind->speed);
        $entity->setWindDeg($this->wind->deg);

        return $entity;
    }
}

class OpenWeatherMapGetWeatherMainDTO
{
    public $temp;
    public $feels_like;
    public $pressure;
    public $humidity;
}

class OpenWeatherMapGetWeatherWindDTO
{
    public $speed;
    public $deg;
}