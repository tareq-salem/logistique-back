<?php

namespace App\Utils;
use App\Utils\FullLocation;

class GeoLocation
{
    private $fullLocationService;

    public function __construct(FullLocation $fullLocationService)
    {
        $this->fullLocationService = $fullLocationService;
    }

    public function geoLoc($address):array
    {
        $fullLocation = $this->fullLocationService->getFullLoc($address);

        $location = $fullLocation[0];
        $coord = array(
            "lat" => $location->lat,
            "lon" => $location->lon
        );
        return $coord;
    }
}