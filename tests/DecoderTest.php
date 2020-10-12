<?php

namespace TheRezor\UaTaxNumber\Tests;

use PHPUnit\Framework\TestCase;
use TheRezor\UaTaxNumber\Decoder;
use TheRezor\UaTaxNumber\InvalidInnException;
use DateTime;

class DecoderTest extends TestCase
{
    protected $valid = '3184710691';
    protected $validWithZero = '3289360690';

    protected $invalid = '2019503024';
    protected $invalidFormat = '019015514';


    public function testInnIsValidPositive()
    {
        $this->assertTrue(Decoder::isValid($this->valid));
        $this->assertTrue(Decoder::isValid($this->validWithZero));
    }

    public function testInnIsValidNegative()
    {
        $this->assertFalse(Decoder::isValid($this->invalid));
        $this->assertFalse(Decoder::isValid($this->invalidFormat));
    }

    public function testGenderPositive()
    {
        $this->assertSame(Decoder::INN_GENDER_MALE, Decoder::gender($this->valid));
        $this->assertSame(Decoder::INN_GENDER_MALE, Decoder::gender($this->validWithZero));
        $this->assertSame(Decoder::INN_GENDER_FEMALE, Decoder::gender($this->invalid));
    }

    public function testGenderNegative()
    {
        $this->expectException(InvalidInnException::class);
        Decoder::gender($this->invalidFormat);
    }

    public function testBirthDatePositive()
    {
        $this->assertSame('1987-03-12', Decoder::birthDate($this->valid)->format('Y-m-d'));
        $this->assertSame('1990-01-21', Decoder::birthDate($this->validWithZero)->format('Y-m-d'));
        $this->assertSame('1955-04-17', Decoder::birthDate($this->invalid)->format('Y-m-d'));
    }

    public function testBirthDateNegative()
    {
        $this->expectException(InvalidInnException::class);
        Decoder::birthDate($this->invalidFormat);
    }

    public function testAgePositive()
    {
        $today = new DateTime('today');

        $this->assertSame((new DateTime('1987-03-12'))->diff($today)->y, Decoder::age($this->valid));
        $this->assertSame((new DateTime('1990-01-21'))->diff($today)->y, Decoder::age($this->validWithZero));
        $this->assertSame((new DateTime('1955-04-17'))->diff($today)->y, Decoder::age($this->invalid));
    }

    public function testAgeNegative()
    {
        $this->expectException(InvalidInnException::class);
        Decoder::age($this->invalidFormat);
    }
}
