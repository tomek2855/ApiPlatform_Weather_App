<?php


namespace App\Services;


use App\Entity\City;
use App\Entity\WeatherRecord;
use App\Exceptions\OpenWeatherMapException;
use App\Models\OpenWeatherMapGetWeatherDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OpenWeatherMapService implements GetWeatherInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var ContainerBagInterface
     */
    private $containerBag;

    public function __construct(SerializerInterface $serializer, ContainerBagInterface $containerBag)
    {
        $this->serializer = $serializer;
        $this->containerBag = $containerBag;
    }

    public function getWeather(City $city): WeatherRecord
    {
        $client = new Client();

        try
        {
            $response = $client->get($this->buildUrl($city));
        }
        catch (GuzzleException $e)
        {
            throw new OpenWeatherMapException($e->getMessage());
        }

        if ($response->getStatusCode() !== 200)
        {
            throw new OpenWeatherMapException('Status code is not 200');
        }

        /**
         * @var OpenWeatherMapGetWeatherDTO
         */
        $dto = $this->serializer->deserialize($response->getBody(), OpenWeatherMapGetWeatherDTO::class, 'json');

        return $dto->toWeatherRecord($city);
    }

    private function buildUrl(City $city) : string
    {
        $apiKey = $this->containerBag->get('openweathermap_api_key');

        return 'https://api.openweathermap.org/data/2.5/weather?q=' . $city->getName() . '&appid=' . $apiKey;
    }
}