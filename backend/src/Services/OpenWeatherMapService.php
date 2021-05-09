<?php


namespace App\Services;


use App\Entity\City;
use App\Entity\WeatherRecord;
use App\Models\OpenWeatherMapGetWeatherDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Serializer\SerializerInterface;

class OpenWeatherMapService implements GetWeatherInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
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
            throw new \Exception();
        }

        if ($response->getStatusCode() !== 200)
        {
            throw new \Exception();
        }

        /**
         * @var OpenWeatherMapGetWeatherDTO
         */
        $dto = $this->serializer->deserialize($response->getBody(), OpenWeatherMapGetWeatherDTO::class, 'json');

        return $dto->toWeatherRecord($city);
    }

    private function buildUrl(City $city)
    {
        $apiKey = 'dd285a5748be29f7cbc6d476cdaa158c';

        return 'https://api.openweathermap.org/data/2.5/weather?q=' . $city->getName() . '&appid=' . $apiKey;
    }
}