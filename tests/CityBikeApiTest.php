<?php

use App\Api\CityBikeApi;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;

class CityBikeApiTest extends TestCase
{
    use PHPMock;

    public function testCityBikeApi(): void
    {
        $apiUrl = 'https://api.citybik.es/v2/networks/bikeu-bra';
        $fileGetContentsMockValue = '{"network":{"company":["Bike U Sp. z o.o."],"href":"/v2/networks/bikeu-bra","id":"bikeu-bra","location":{"city":"Bydgoszcz","country":"PL","latitude":53.12193,"longitude":18.00038},"name":"Bydgoski rower aglomeracyjny","stations":[{"empty_slots":7,"extra":{"uid":1},"free_bikes":8,"id":"92ff9507511906bf6f5d4b2f8c9817a3","latitude":53.125323,"longitude":17.987243,"name":"01. Rondo Grunwaldzkie","timestamp":"2023-07-11T19:24:04.017000Z"},{"empty_slots":8,"extra":{"uid":2},"free_bikes":7,"id":"32d6c0fbf8e6a286264e1789b9e3982f","latitude":53.123905,"longitude":18.007008,"name":"02. Rondo Jagiellonów","timestamp":"2023-07-11T19:24:04.019000Z"}]}}';
        $expected = [[
            'address' => '01. Rondo Grunwaldzkie',
            'latitude' => 53.125323,
            'longitude' => 17.987243,
            'free_bikes' => 8
        ],
            [
                'address' => '02. Rondo Jagiellonów',
                'latitude' => 53.123905,
                'longitude' => 18.007008,
                'free_bikes' => 7
            ],
        ];
        $fileGetContentsMock = $this->getFunctionMock('\\App\\Api', 'file_get_contents');
        $fileGetContentsMock->expects($this->once())
            ->with($apiUrl)
            ->willReturn($fileGetContentsMockValue);

        $service = $this->getMockBuilder(CityBikeApi::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $result = $service->getFile($apiUrl);

        $this->assertEquals($expected, $result);
    }
}

