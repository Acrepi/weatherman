<?php

namespace App\Controller;

use App\Entity\Weather;
use App\Form\WeatherType;
use App\Repository\WeatherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/measurement')]
class WeatherMeasurementController extends AbstractController
{
    #[Route('/', name: 'app_weather_measurement_index', methods: ['GET'])]
    public function index(WeatherRepository $weatherRepository): Response
    {
        return $this->render('weather_measurement/index.html.twig', [
            'weather' => $weatherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_weather_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weather = new Weather();
        $form = $this->createForm(WeatherType::class, $weather, [
            'validation_groups' => 'create'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($weather);
            $entityManager->flush();

            return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weather_measurement/new.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weather_measurement_show', methods: ['GET'])]
    public function show(Weather $weather): Response
    {
        return $this->render('weather_measurement/show.html.twig', [
            'weather' => $weather,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_weather_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Weather $weather, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WeatherType::class, $weather, [
            'validation_groups' => 'edit'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weather_measurement/edit.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weather_measurement_delete', methods: ['POST'])]
    public function delete(Request $request, Weather $weather, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weather->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weather);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
