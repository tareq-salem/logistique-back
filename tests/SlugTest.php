<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Utils\Slugger;

class SlugTest extends TestCase
{
    public function test1()
    {
        $strToTest = 'une chaine de caractere a slugger';
        $slugger = new Slugger();
        $strExpected = 'une-chaine-de-caractere-a-slugger';
        $this->assertSame($strExpected, $slugger->slugify($strToTest));
    }

    public function test2()
    {
        $strToTest = 'UNE CHAINE A SLUGGER';
        $slugger = new Slugger();
        $strExpected = 'une-chaine-a-slugger';
        $this->assertSame($strExpected, $slugger->slugify($strToTest));
    }

    public function test3()
    {
        $strToTest = 'Une chaîne de caractère à slugger';
        $slugger = new Slugger();
        $strExpected = 'une-chaine-de-caractere-a-slugger';
        $this->assertSame($strExpected, $slugger->slugify($strToTest));
    }

    public function test4()
    {
        $strToTest = 'Une chaine de caractère à re-slugger';
        $slugger = new Slugger();
        $strExpected = 'une-chaine-de-caractere-a-re-slugger';
        $this->assertSame($strExpected, $slugger->slugify($strToTest));
    }

    public function test5()
    {
        $strToTest = '\\a_àéàç\'_(è';
        $slugger = new Slugger();
        $strExpected = '-a-aeac-e';
        $this->assertSame($strExpected, $slugger->slugify($strToTest));
    }
}
