<?php
namespace Gileson\Api\Collections;

use Gileson\Api\AcrmApiException;
use Gileson\Api\Models\Model;

abstract class Collection {

    /**
     * @var string|null|Model
     */
    protected $model = null;
    /**
     * @var array
     */
    protected $items = [];

    function __construct($items) {
        $this->setItems($items);
    }

    /**
     * @param $items
     *
     * @return static
     */
    static function create($items){
        return new static($items);
    }

    /**
     * @param $items
     *
     * @return $this
     * @throws AcrmApiException
     */
    protected function setItems($items) {
        if(is_null($this->model)) {
            $this->items = $items;
        } else {
            $class = $this->model;
            if(!is_a($class, Model::class, true)){
                throw new AcrmApiException('Модель ['.$class.'] должна наследоваться от [Gileson\Api\Models\Model]');
            }
            foreach($items as $item) {
                $this->items[] = new $class($item);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    function toArray() {
        if(is_null($this->model)) {
            return $this->items;
        }
        $ret = [];
        foreach($this->items as $item) {
            /** @var Model $item */
            $ret[] = $item->toArray();
        }

        return $ret;
    }

}