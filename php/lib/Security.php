<?php
class Security{
    private static $seed = 'h66';
    private static $seed1 = 'F99';
    private static $seedLink = 'h001326t99';
    private static $seedLinkEnd = 'stoptr36666';

    static public function getSeed() {
        return self::$seed;
    }

    static public function getSeedMail(){
        return self::$seed1;
    }

    static public function getSeedLink(){
        return self::$seedLink;
    }

    static public function getSeedLinkEnd(){
        return self::$seedLinkEnd;
    }
}