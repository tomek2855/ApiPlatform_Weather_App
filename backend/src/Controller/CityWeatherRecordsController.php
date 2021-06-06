<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/cities/{id}/weather_records")
 */
class CityWeatherRecordsController extends AbstractController
{
    /**
     * @Route("/", name="city_weather_records", methods={"GET"})
     */
    public function index(CityRepository $cityRepository, SerializerInterface $serializer, $id): Response
    {
        $city = $cityRepository->find($id);

        if (!$city) {
            throw new BadRequestException();
        }

        $weatherRecords = $city->getWeatherRecords();

        return new Response($serializer->serialize($weatherRecords, 'json'));
    }
}
