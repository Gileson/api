<?php
namespace Gileson\Api\Methods;

use Gileson\Api\AcrmRequest;
use Gileson\Api\Response\CategoriesResponse;
use Gileson\Api\Response\CategoryResponse;
use Gileson\Api\Response\FailResponse;

class Category extends AcrmRequest {

    const SECTION = 'categories';

    /**
     * @return CategoriesResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function getList() {
        $result = $this->send($this->getMethodUrl());
        if($result instanceof FailResponse) {
            return $result;
        }

        return new CategoriesResponse($result);
    }

    /**
     * @return CategoryResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function getItem($id) {
        if(!$id) {
            return new FailResponse('Для получения категории необходимо передать ее ID');
        }
        $result = $this->send($this->getMethodUrl($id));
        if($result instanceof FailResponse) {
            return $result;
        }

        return new CategoryResponse($result);
    }

    /**
     * @return CategoryResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function store($parameters, $id = null) {
        $result = $this->send($this->getMethodUrl($id, is_null($id) ? 'create' : 'store'), $parameters, 'post');
        if($result instanceof FailResponse) {
            return $result;
        }

        return new CategoryResponse($result);
    }

}