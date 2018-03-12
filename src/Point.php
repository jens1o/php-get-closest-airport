<?php
declare(strict_types=1);

namespace jens1o\airport;

/**
 * Represents a point on a sphere.
 *
 * @author      jens1o
 * @copyright   Jens Hausdorf 2018
 * @license     MIT License
 * @package     jens1o
 * @subpackage  airport
 */
class Point implements IPoint {

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

    /**
     * Creates a new point on a sphere.
     *
     * @param   float   $lat    the latitude in degrees
     * @param   float   $long   the longitude in degrees
     */
    public function __construct(float $lat, float $long) {
        if ($lat < -90 || $lat > 90) {
            throw new \RangeException('The latitude should be between -90° and +90°, ' . $lat . ' given');
        }
        if ($long < -180 || $long > 180) {
            throw new \RangeException('The longitude should be between -180° and +180°, ' . $lat . ' given');
        }

        $this->latitude = $lat;
        $this->longitude = $long;
    }

    /**
     * @inheritDoc
     */
    public function getLatitude(): float {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     */
    public function getLongitude(): float {
        return $this->longitude;
    }

    /**
     * @inheritDoc
     */
    public function getDistance(IPoint $point2): float {
        if (
            $this->getLatitude() === $point2->getLatitude()
            && $this->getLongitude() === $point2->getLongitude()
        ) {
            // points are the same
            return 0.0;
        }

        // see https://stackoverflow.com/a/40760301/8496913

        $rad1 = deg2rad($this->getLatitude());
        $rad2 = deg2rad($point2->getLatitude());

        $distance = rad2deg(
            acos(
                    (
                        sin($rad1) * sin($rad2)
                    ) + (
                        cos($rad1) * cos($rad2) * cos(
                            deg2rad(
                                $this->getLongitude() - $point2->getLongitude()
                            )
                        )
                    )
            )
        );

        return $distance * 111.13384; // convert degrees to kilometer
    }

}