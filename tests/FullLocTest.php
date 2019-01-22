<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Utils\FullLocalisation;

class FullLocTest extends TestCase
{
    public function test1()
    {
        $address = 'lyon';
        $loc = new FullLocalisation();
        $expectedAddress = 'du json en string';
        $this->assertSame($expectedAddress, $loc->getFullLoc($address));
    }
}