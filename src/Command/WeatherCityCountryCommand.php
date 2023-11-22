<?php

namespace App\Command;

use App\Repository\PlaceRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:city_country',
    description: 'Add a short description for your command',
)]
class WeatherCityCountryCommand extends Command
{
    public function __construct(private PlaceRepository $placeRepository, private WeatherUtil $weatherUtil)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('city', InputArgument::REQUIRED, 'City name')
            ->addArgument('country', InputArgument::REQUIRED, 'Country code')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $country = $input->getArgument('country');
        $city = $input->getArgument('city');

        $place = $this->placeRepository->findOneBy([
            'country_code' => $country,
            'city' => $city,
        ]);

        $measurements = $this->weatherUtil->getWeatherForPlace($place);
        $io->writeln(sprintf('Location: %s', $place->getCity()));
        foreach ($measurements as $measurement) {
            $io->writeln(sprintf("\t%s: %s",
                $measurement->getDate()->format('Y-m-d'),
                $measurement->getTemperature()
            ));
        }

        return Command::SUCCESS;
    }
}
