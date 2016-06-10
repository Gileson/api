<?php
namespace Gileson\Api\Response;

use Gileson\Api\Collections\Collection;
use Gileson\Api\Models\Model;

abstract class Response {

    protected $result = null;

    function __construct($data = []) {
        if(is_object($data) || is_array($data)) {
            foreach($data as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }
    }

    /**
     * @return bool
     */
    function isValid() {
        return true;
    }

    /**
     * @param $key
     * @param $value
     */
    function setAttribute($key, $value) {
        $method = str_camel('set_' . $key);
        if(method_exists($this, $method)) {
            call_user_func([$this, $method], $value);
        }
    }

    /**
     * @param $result
     *
     * @return $this
     */
    function setResult($result) {
        $this->result = $result;

        return $this;
    }

    /**
     * Получение всех параметров в массиве
     * 
     * @return array
     */
    function toArray() {
        $ret = [];
        foreach($this as $key => $value) {
            if(is_a($value, Collection::class) || is_a($value, Model::class)) {
                /** @var Collection $value */
                $ret[$key] = $value->toArray();
            } else {
                $ret[$key] = $value;
            }
        }

        return $ret;
    }

}