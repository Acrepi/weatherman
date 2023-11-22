<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Place;
use App\Entity\Weather;
use App\Repository\WeatherRepository;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country_code}', name: 'app_weather')]
    public function city(
        #[MapEntity(mapping: ['city' => 'city', 'country_code' => 'country_code'])] Place $place,
        WeatherUtil $util
    ): Response
    {
        $weather = $util->getWeatherForPlace($place);
    
        return $this->render('weather/city.html.twig', [
            'place' => $place,
            'weather' => $weather,
        ]);
    }

    #[Route('/weather/{city}', name: 'app_weather2')]
    public function city2(
        #[MapEntity(mapping: ['city' => 'city'])] Place $place,
        WeatherUtil $util
    ): Response
    {
        $weather = $util->getWeatherForPlace($place);
    
        return $this->render('weather/city.html.twig', [
            'place' => $place,
            'weather' => $weather,
        ]);
    }
}
