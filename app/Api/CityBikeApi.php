<?php

namespace App\Api;

use App\Interfaces\ICityBikeApi;
use JsonException;

class CityBikeApi implements ICityBikeApi
{
    /**
     * @throws JsonException
     */
    public function getFile(string $apiUrl): array
    {
        $content = json_decode(file_get_contents($apiUrl), true, 512, JSON_THROW_ON_ERROR);
        return $this->prepareResponse($content);
    }

    private function prepareResponse(array $response): array
    {
        $stationInfo = array();
        if (isset($response['network']['stations']) && is_array( $response['network']['stations'])) {
            foreach ($response['network']['stations'] as $stat) {
                $stationInfo[] = array(
                    "address" => $stat['name'] ?? null,
                    "latitude" => $stat['latitude'] ?? null,
                    "longitude" => $stat['longitude'] ?? null,
                    "free_bikes" => $stat['free_bikes'] ?? null
                );
            }
        }
        return $stationInfo;
    }
}