<?php
namespace Gileson\Api;


class Token {

    static protected $token = null;

    /**
     * @return null
     */
    static function getToken() {
        return self::$token;
    }

    /**
     * @param $token
     */
    static function setToken($token) {
        self::$token = $token;
    }

}