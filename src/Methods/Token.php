<?php
namespace Gileson\Api\Methods;

use Gileson\Api\AcrmRequest;
use Gileson\Api\Response\FailResponse;
use Gileson\Api\Response\GetTokenResponse;

class Token extends AcrmRequest {

    const SECTION = 'get-token';

    /**
     * Получение Auth-token
     *
     * @param $user_name
     * @param $secret
     *
     * @return GetTokenResponse|FailResponse
     */
    function get($login, $secret) {
        $result = $this->send($this->getMethodUrl(), compact('login', 'secret'), 'POST', false);
        if($result instanceof FailResponse) {
            return $result;
        }

        return new GetTokenResponse($result);
    }

}