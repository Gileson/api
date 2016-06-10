<?php
namespace Gileson\Api\Models;

use Gileson\Api\Collections\Collection;

class Model {

    protected $attributes = [];
    protected $fields     = [];

    function __construct($attributes = []) {
        if(is_object($attributes) || is_array($attributes)) {
            foreach($attributes as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }
    }

    static function create($attributes = []){
        return new static($attributes);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    function setAttribute($key, $value) {
        if(!in_array($key, $this->fields)) {
            return $this;
        }
        $method = str_camel('set_' . $key);
        if(method_exists($this, $method)) {
            call_user_func([$this, $method], $value);
        } else {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    function getOriginalAttribute($key) {
        if(isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    function getAttribute($key) {
        if(!in_array($key, $this->fields)) {
            return null;
        }
        $method = str_camel('get_' . $key);
        if(method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }elseif(isset($this->attributes[$key])){
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    function __set($key, $value) {
        return $this->setAttribute($key, $value);
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    function __get($key) {
        return $this->getAttribute($key);
    }

    /**
     * @return array
     */
    function toArray() {
        $ret = [];
        foreach($this->fields as $field) {
            $value = $this->getAttribute($field);
            if(is_a($value, Model::class) || is_a($value, Collection::class)){
                $value = $value->toArray();
            }
            $ret[$field] = $value;
        }

        return $ret;
    }

}