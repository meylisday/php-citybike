<?php
namespace App;

use Exception;

class CityBike
{
    /**
     * @throws Exception
     */
    public function getClosestBikeStations(array $stationInfo, array $bikers): array
    {
        $shortestDistances = array();
        foreach ($bikers as $biker) {
            $shortest_distance = PHP_INT_MAX;
            $closest_station_address = '';
            $free_bike_count = 0;
            $biker_count = 0;
            foreach ($stationInfo as $station) {
                $distance = $this->getDistance($station["latitude"], $station["longitude"], $biker["latitude"], $biker["longitude"]);
                if ($distance < $shortest_distance) {
                    $shortest_distance = $distance;
                    $closest_station_address = $station["address"];
                    $free_bike_count = $station["free_bikes"];
                    $biker_count = $biker["count"];
                }
            }
            $shortestDistances[] = [
                "address" => $closest_station_address,
                "distance" => $shortest_distance,
                "free_bike_count" => $free_bike_count,
                "biker_count" => $biker_count
            ];
        }
        return $shortestDistances;
    }

    public function getDistance(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float
    {
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        return $earth_radius * $c;
    }
}