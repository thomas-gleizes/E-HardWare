<?php
class Security{
    private static $seed = 'h66';
    private static $seed1 = 'F99';

    static public function getSeed() {
        return self::$seed;
    }

    static public function getSeedMail(){
        return self::$seed1;
    }
}