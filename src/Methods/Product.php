<?php
namespace Gileson\Api\Methods;

use Gileson\Api\AcrmRequest;
use Gileson\Api\Response\FailResponse;
use Gileson\Api\Response\ProductResponse;
use Gileson\Api\Response\ProductsResponse;
use Illuminate\Support\Arr;

class Product extends AcrmRequest {

    const SECTION = 'products';

    /**
     * @param string $search
     * @param int    $page
     * @param int    $limit
     * @param array  $categories
     *
     * @return ProductsResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function getList($search = '', $page = 1, $limit = 50, $categories = []) {
        $result = $this->send($this->getMethodUrl(), compact('page', 'categories', 'limit', 'search'));

        if($result instanceof FailResponse) {
            return $result;
        }

        return new ProductsResponse($result);
    }

    /**
     * @return ProductResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function getItem($id) {
        if(!$id) {
            return new FailResponse('Для получения товара необходимо передать его ID');
        }
        $result = $this->send($this->getMethodUrl($id));
        if($result instanceof FailResponse) {
            return $result;
        }

        return new ProductResponse($result);
    }

    function store(array $data) {
        $id = Arr::get($data, 'id');
        $result = $this->send($this->getMethodUrl($id, $id ? 'store' : 'create'), $data, 'POST');
        if($result instanceof FailResponse) {
            return $result;
        }

        return new ProductResponse($result);
    }

}