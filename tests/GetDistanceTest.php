<?php

namespace tests;

use App\CityBike;
use PHPUnit\Framework\TestCase;

class GetDistanceTest extends TestCase
{
    public function testGetDistance(): void
    {
        $cityBike = new CityBike();

        $latitude1 = 51.123;
        $longitude1 = -0.456;
        $latitude2 = 51.789;
        $longitude2 = -0.123;

        $expectedDistance = 77.56659844254591;

        $actualDistance = $cityBike->getDistance($latitude1, $longitude1, $latitude2, $longitude2);

        $this->assertEqualsWithDelta($expectedDistance, $actualDistance, 0.0001, '');

        $latitude1 = 40.7128;
        $longitude1 = -74.0060;
        $latitude2 = 34.0522;
        $longitude2 = -118.2437;

        $expectedDistance = 3935.746254609723;

        $actualDistance = $cityBike->getDistance($latitude1, $longitude1, $latitude2, $longitude2);

        $this->assertEqualsWithDelta($expectedDistance, $actualDistance, 0.0001, '');
    }
}
