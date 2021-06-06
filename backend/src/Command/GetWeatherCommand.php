<?php

namespace App\Command;

use App\Entity\City;
use App\Services\GetWeatherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetWeatherCommand extends Command
{
    protected static $defaultName = 'app:get-weather';
    protected static $defaultDescription = 'Download weather from API';

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var GetWeatherInterface
     */
    private $weatherApi;

    public function __construct(string $name = null, EntityManagerInterface $entityManager, GetWeatherInterface $weatherApi)
    {
        parent::__construct($name);
        $this->em = $entityManager;
        $this->weatherApi = $weatherApi;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $citiesRepository = $this->em->getRepository(City::class);
        $cities = $citiesRepository->findAll();

        foreach ($cities as $city)
        {
            $io->info('Downloading ' . $city->getName() . ' weather.');

            $entity = $this->downloadCityWeather($city);

            $this->em->persist($entity);
        }

        $this->em->flush();

        $io->success('Download successed!');

        return Command::SUCCESS;
    }

    protected function downloadCityWeather(City $city)
    {
        return $this->weatherApi->getWeather($city);
    }
}
