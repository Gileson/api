<?php 
namespace Gileson\Api\Response;

class GetTokenResponse extends Response {

    protected $token = null;

    protected function setToken($token){
        $this->token = $token;
        return $this;
    }

    function getToken(){
        return $this->token;
    }

}