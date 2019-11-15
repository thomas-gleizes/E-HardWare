<?php
class Security{
    private static $seed = 'h66';

    static public function getSeed() {
        return self::$seed;
    }
}