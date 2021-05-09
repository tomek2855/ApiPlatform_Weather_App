<?php


namespace App\Services;


use App\Entity\City;
use App\Entity\WeatherRecord;

interface GetWeatherInterface
{
    function getWeather(City $city) : WeatherRecord;
}