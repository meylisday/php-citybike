<?php
//function custom_autoloader($class): void
//{
//    include 'src/' . $class . '.php';
//}
//
//spl_autoload_register('custom_autoloader');
require './vendor/autoload.php';
$apiUrl = "https://api.citybik.es/v2/networks/bikeu-bra";

try {
    $stationInfo = (new CityBikeApi())->getFile($apiUrl);
    $parser = FileFactory::getFileParser("csv");
    $bikers = $parser->parseFile("bikers.csv");
    $shortestDistances = (new CityBike())->getClosestBikeStations($stationInfo, $bikers);

    foreach ($shortestDistances as $shortestDistance) {
        echo "distance: " . $shortestDistance["distance"] . PHP_EOL;
        echo "address: " . $shortestDistance["address"] . PHP_EOL;
        echo "free_bike_count: " . $shortestDistance["free_bike_count"] . PHP_EOL;
        echo "biker_count: " . $shortestDistance["biker_count"] . PHP_EOL;
        echo PHP_EOL;
    }

} catch (Exception $e) {
    echo $e->getMessage() .' in '. $e->getFile() .' at line ' . $e->getLine() . PHP_EOL;
}