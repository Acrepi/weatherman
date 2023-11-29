<?php

namespace App\Tests\Ntity;

use App\Entity\Weather;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{

    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['0.5', 32.9],
            ['7.2', 44.96],
            ['10.3', 50.54],
            ['-17.5', 0.5],
            ['17.5', 63.5],
            ['-100', -148],
            ['-100.1', -148.18],
            ['100', 212],
            ['100.1', 212.18]
        ];
    }

    /**
     * @dataProvider dataGetFahrenheit
     */
    public function testGetFahrenheit($temperature, $expectedFahrenheit): void
    {
        $measurement = new Weather();

        $measurement->setTemperature($temperature);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit(), "Expected $expectedFahrenheit Fahrenheit for $temperature Celsius, got {$measurement->getFahrenheit()}");
    }
}
