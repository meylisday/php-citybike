<?php

class CityBikeApi implements ICityBikeApi
{
    /**
     * @throws JsonException
     */
    public function getFile(string $apiIrl): array
    {
        $content = file_get_contents($apiIrl);
        $parsedResponse = $this->parseResponse($content);
        return $this->prepareResponse($parsedResponse);
    }

    /**
     * @throws JsonException
     */
    private function parseResponse(?string $contentUrl): stdClass
    {
        return json_decode($contentUrl, false, 512, JSON_THROW_ON_ERROR);
    }

    private function prepareResponse(stdClass $response): array
    {
        $stationInfo = array();
        if (isset($response->network, $response->network->stations) && is_array($response->network->stations)) {
            foreach ($response->network->stations as $stat) {
                $stationInfo[] = array(
                    "address" => $stat->name ?? null,
                    "latitude" => $stat->latitude ?? null,
                    "longitude" => $stat->longitude ?? null,
                    "free_bikes" => $stat->free_bikes ?? null
                );
            }
        }
        return $stationInfo;
    }
}