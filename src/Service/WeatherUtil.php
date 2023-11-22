<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Place;
use App\Entity\Measurement;
use App\Entity\Weather;
use App\Repository\WeatherRepository;
use App\Repository\PlaceRepository;

class WeatherUtil
{
    public function __construct(private WeatherRepository $weatherRepository, private PlaceRepository $placeRepository)
    {
        
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForPlace(Place $place): array
    {
        $measurements = $this->weatherRepository->findByPlace($place);
        return $measurements;
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->placeRepository->findOneBy([
            'country' => $countryCode,
            'city' => $city,
        ]);

        $measurements = $this->getWeatherForPlace($location);

        return $measurements;
    }
}