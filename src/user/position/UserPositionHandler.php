<?php
declare(strict_types=1);

namespace jens1o\airport\user\position;

use jens1o\airport\IPoint;
use jens1o\airport\Point;
use jens1o\airport\SingletonFactory;

class UserPositionHandler extends SingletonFactory {

    /**
     * Represents the Point<Lat, Long> where the user is.
     *
     * @var IPoint|null
     */
    protected $userPosition;

    protected function init(): void {
        $this->fetchLocation();
    }

    /**
     * Tries to find out the current location
     */
    protected function fetchLocation(): void {
        try {
            // TODO: Add PSR-16 caching and put this into another class(perhaps use guzzle?)
            // $locInfo = json_decode(file_get_contents('https://ipinfo.io/' . $_SERVER['REMOTE_ADDR'] . '/geo'), true);
            $locInfo = ['loc' => '49.0111,8.3601'];
        } catch (\Throwable $e) {
            // try to get location from current/default timezone
            $timezone = new \DateTimeZone(\date_default_timezone_get());
            $location = $timezone->getLocation();

            $locInfo = ['loc' => $location['latitude'] . ',' . $location['longitude']];
        }

        $locationString = \explode(',', $locInfo['loc'], 2);

        $this->userPosition = new Point((float) $locationString[0], (float) $locationString[1]);
    }

    /**
     * Returns the guessed position of the user
     *
     * @return IPoint
     */
    public function getUserPosition(): IPoint {
        return $this->userPosition;
    }

}