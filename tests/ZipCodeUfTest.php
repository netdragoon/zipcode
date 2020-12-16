<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCodeUf;
use PHPUnit\Framework\TestCase;

class ZipCodeUfTest extends TestCase
{
  public function testArrayListUf()
  {
    $data = ZipCodeUf::lists();
    $this->assertIsArray($data);
  }

  public function testArrayListUfCount27()
  {
    $data = ZipCodeUf::lists();
    $this->assertIsArray($data);
    $this->assertIsInt(count($data));
    $this->assertTrue(count($data) > 0);
    $this->assertTrue(count($data) === 27);
  }

  public function testArrayListUfValues()
  {
    $this->assertEquals('ac', ZipCodeUf::AC);
    $this->assertEquals('al', ZipCodeUf::AL);
    $this->assertEquals('ap', ZipCodeUf::AP);
    $this->assertEquals('am', ZipCodeUf::AM);
    $this->assertEquals('ba', ZipCodeUf::BA);
    $this->assertEquals('ce', ZipCodeUf::CE);
    $this->assertEquals('df', ZipCodeUf::DF);
    $this->assertEquals('es', ZipCodeUf::ES);
    $this->assertEquals('go', ZipCodeUf::GO);
    $this->assertEquals('ma', ZipCodeUf::MA);
    $this->assertEquals('mt', ZipCodeUf::MT);
    $this->assertEquals('ms', ZipCodeUf::MS);
    $this->assertEquals('mg', ZipCodeUf::MG);
    $this->assertEquals('pr', ZipCodeUf::PR);
    $this->assertEquals('pb', ZipCodeUf::PB);
    $this->assertEquals('pa', ZipCodeUf::PA);
    $this->assertEquals('pe', ZipCodeUf::PE);
    $this->assertEquals('pi', ZipCodeUf::PI);
    $this->assertEquals('rj', ZipCodeUf::RJ);
    $this->assertEquals('rn', ZipCodeUf::RN);
    $this->assertEquals('rs', ZipCodeUf::RS);
    $this->assertEquals('ro', ZipCodeUf::RO);
    $this->assertEquals('rr', ZipCodeUf::RR);
    $this->assertEquals('sc', ZipCodeUf::SC);
    $this->assertEquals('se', ZipCodeUf::SE);
    $this->assertEquals('sp', ZipCodeUf::SP);
    $this->assertEquals('to', ZipCodeUf::TO);
  }

  public function testArrayDataUfValues()
  {
    $data = ZipCodeUf::lists();
    $this->assertEquals($data['AC'], ZipCodeUf::AC);
    $this->assertEquals($data['AL'], ZipCodeUf::AL);
    $this->assertEquals($data['AP'], ZipCodeUf::AP);
    $this->assertEquals($data['AM'], ZipCodeUf::AM);
    $this->assertEquals($data['BA'], ZipCodeUf::BA);
    $this->assertEquals($data['CE'], ZipCodeUf::CE);
    $this->assertEquals($data['DF'], ZipCodeUf::DF);
    $this->assertEquals($data['ES'], ZipCodeUf::ES);
    $this->assertEquals($data['GO'], ZipCodeUf::GO);
    $this->assertEquals($data['MA'], ZipCodeUf::MA);
    $this->assertEquals($data['MT'], ZipCodeUf::MT);
    $this->assertEquals($data['MS'], ZipCodeUf::MS);
    $this->assertEquals($data['MG'], ZipCodeUf::MG);
    $this->assertEquals($data['PR'], ZipCodeUf::PR);
    $this->assertEquals($data['PB'], ZipCodeUf::PB);
    $this->assertEquals($data['PA'], ZipCodeUf::PA);
    $this->assertEquals($data['PE'], ZipCodeUf::PE);
    $this->assertEquals($data['PI'], ZipCodeUf::PI);
    $this->assertEquals($data['RJ'], ZipCodeUf::RJ);
    $this->assertEquals($data['RN'], ZipCodeUf::RN);
    $this->assertEquals($data['RS'], ZipCodeUf::RS);
    $this->assertEquals($data['RO'], ZipCodeUf::RO);
    $this->assertEquals($data['RR'], ZipCodeUf::RR);
    $this->assertEquals($data['SC'], ZipCodeUf::SC);
    $this->assertEquals($data['SE'], ZipCodeUf::SE);
    $this->assertEquals($data['SP'], ZipCodeUf::SP);
    $this->assertEquals($data['TO'], ZipCodeUf::TO);
  }
}
