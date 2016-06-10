<?php
namespace Gileson\Api\Methods;

use Gileson\Api\AcrmRequest;
use Gileson\Api\Response\FailResponse;
use Gileson\Api\Response\ProductResponse;

class Product extends AcrmRequest {

    const SECTION = 'products';

    /**
     * @param string $search
     * @param int    $page
     * @param int    $limit
     * @param array  $categories
     *
     * @return ProductResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function getList($search = '', $page = 1, $limit = 50, $categories = []) {
        $result = $this->send($this->getMethodUrl(), compact('page', 'categories', 'limit', 'search'));

        if($result instanceof FailResponse) {
            return $result;
        }

        return new ProductResponse($result);
    }

}