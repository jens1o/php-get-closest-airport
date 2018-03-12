<?php
declare(strict_types=1);

namespace jens1o\airport;

/**
 * Interface for points that are located on spheres
 *
 * @author      jens1o
 * @copyright   Jens Hausdorf 2018
 * @license     MIT License
 * @package     jens1o
 * @subpackage  airport
 */
interface IPoint {

    /**
     * Returns the latitude of this point.
     *
     * @return float
     */
    public function getLatitude(): float;

    /**
     * Returns the longitude of this point.
     *
     * @return float
     */
    public function getLongitude(): float;

    /**
     * Reuturns the distance to `$point2`, in meters.
     *
     * @param   IPoint  $point2
     * @return float
     */
    public function getDistance(IPoint $point2): float;

}