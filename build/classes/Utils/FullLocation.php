<?php

namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\EntityBody;

class FullLocation
{
    public function getFullLoc(string $address): array
    {
        $client = new Client(['headers' => ['User-Agent' => 'logisticc']]);
        $response = $client->request('GET', "https://nominatim.openstreetmap.org/search?format=json&q={$address}");
        $body = json_decode((string) $response->getBody());
        return $body;
    }
}