<?php
declare(strict_types=1);

use jens1o\airport\user\position\UserPositionHandler;
use jens1o\airport\AirportListFactory;
use jens1o\airport\Airport;

/**
 * Handles the request.
 * TODO: Perhaps add a MVC system to simplify this file?
 *
 * @author     jens1o
 * @copyright  Jens Hausdorf 2018
 * @license    MIT License
 */
require './../vendor/autoload.php';

// lookup position of current user
$userPosition = UserPositionHandler::getInstance()->getUserPosition();

// read airports
$airportList = new AirportListFactory;
$airports = $airportList->getDecoratedList();

// order by distance
$nearestAirport = $distance = null;
foreach ($airports as $airport) {
    $airportDistance = $airport->getDistance($userPosition);
    if ($distance === null || $distance > $airportDistance) {
        $distance = $airportDistance;
        $nearestAirport = $airport;
    }
}

echo 'The nearest airport is ' . $distance . 'km away! It is ' . $nearestAirport->getName() . '<br>';

echo 'Took ' . round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 2) . 's';