<?php namespace Canducci\ZipCode;

/**
 * Class ZipCodeUf
 * @package Canducci\ZipCode
 */
abstract class ZipCodeUf
{
    const AC = 'ac';
    const AL = 'al';
    const AP = 'ap';
    const AM = 'am';
    const BA = 'ba';
    const CE = 'ce';
    const DF = 'df';
    const ES = 'es';
    const GO = 'go';
    const MA = 'ma';
    const MT = 'mt';
    const MS = 'ms';
    const MG = 'mg';
    const PR = 'pr';
    const PB = 'pb';
    const PA = 'pa';
    const PE = 'pe';
    const PI = 'pi';
    const RJ = 'rj';
    const RN = 'rn';
    const RS = 'rs';
    const RO = 'ro';
    const RR = 'rr';
    const SC = 'sc';
    const SE = 'se';
    const SP = 'sp';
    const TO = 'to';

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function lists()
    {
        $rf = new \ReflectionClass("Canducci\ZipCode\ZipCodeUf");
        $data = $rf->getConstants();
        unset($rf);
        return $data;
    }
}