<?php
namespace Gileson\Api;

use Gileson\Api\Response\FailResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

/**
 * @package Gileson\Api
 */
abstract class AcrmRequest {

    /**
     * Базовый урл
     */
    const BASE_URL = 'http://acrm2.os/api/v2/';
    /**
     * Текущий раздел
     */
    const SECTION = null;

    /**
     * Токен, для обращения к апи
     * @var null
     */
    protected $token = null;

    protected static $instance = [];

    protected $result = null;

    /**
     * @return static
     */
    static function instance() {
        $class = static::class;
        if(!isset(self::$instance[$class])) {
            self::$instance[$class] = new static();
        }

        return self::$instance[$class];
    }

    /**
     * Отправка запроса в ACRM
     *
     * @param        $url
     * @param array  $params
     * @param string $method
     * @param bool   $need_token
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws AcrmApiException
     */
    protected function send($url, $params = [], $method = 'GET', $need_token = true) {
        $method = mb_strtoupper($method);
        $client = new Client();
        if($need_token) {
            $token = $this->getToken();
            if(!$token) {
                throw new AcrmApiException('Для запроса [' . $url . '] необходим Auth-token');
            }
            $params['token'] = $this->getToken();
        }

        try {
            if('GET' == $method) {
                $url .= (false === mb_stripos($url, '?') ? '?' : '&') . http_build_query($params);

                $result = $client->request($method, $url);
            } else {
                $result = $client->request($method, $url, [
                    RequestOptions::FORM_PARAMS => $params,
                ]);
            }
        }
        catch(RequestException $e) {
            return new FailResponse((string) $e->getResponse()->getBody());
        }

        return json_decode($result->getBody());
    }

    /**
     * Получение токена, если он необходим в запросе
     * 
     * @return null
     */
    protected function getToken() {
        if(is_null($this->token)) {
            $this->token = Token::getToken();
        }

        return $this->token;
    }

    /**
     * Получение адреса для обращения к апи по методу
     *
     * @param null   $id
     * @param string $action
     *
     * @throws AcrmApiException
     */
    function getMethodUrl($id = null, $action = '') {
        if(!static::SECTION) {
            throw new AcrmApiException('Необходимо указать метод');
        }
        $ret   = [];
        $ret[] = static::BASE_URL . static::SECTION;
        if($id) {
            $ret[] = $id;
        }
        if($action) {
            $ret[] = $action;
        }

        return implode('/', $ret);
    }

}