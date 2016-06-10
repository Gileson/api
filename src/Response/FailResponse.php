<?php
namespace Gileson\Api\Response;

use Gileson\Api\ApiTokenException;

class FailResponse {

    protected $message = null;
    protected $result  = 'error';
    protected $data    = [];

    function __construct($data) {
        $json = json_decode($data);
        if($json) {
            $this->setMessage($json->message);
            $this->setData((array) $json);
        } else {
            $this->setMessage('Произошла неизвестная ошибка');
            $this->setData([
                'response' => $data,
            ]);
        }
    }

    function isValid() {
        return false;
    }

    protected function setMessage($message) {
        $this->message = $message;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        if(isset($data['code']) && 'token' == $data['code']){
            throw new ApiTokenException($this->getMessage());
        }
        return $this;
    }

    /**
     * @return null|string
     */
    function getMessage() {
        return $this->message;
    }

    /**
     * @return array
     */
    function getData() {
        return $this->data;
    }

    function getResult() {
        return $this->result;
    }

    function toArray() {
        $ret = [];
        foreach($this as $key => $value) {
            $ret[$key] = $value;
        }

        return $ret;
    }

}