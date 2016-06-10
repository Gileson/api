<?php
namespace Gileson\Api\Response;

use Gileson\Api\Collections\Products;

class ProductResponse extends Response {

    /**
     * @var Products
     */
    protected $products = [];
    protected $page     = 1;
    protected $count    = 0;
    protected $limit    = 50;

    /**
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit($limit) {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function setPage($page) {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function setCount($count) {
        $this->count = $count;

        return $this;
    }

    /**
     * @param $products
     *
     * @return $this
     */
    protected function setProducts($products) {
        $this->products = Products::create($products);

        return $this;
    }

    /**
     * @return Products
     */
    function getProducts() {
        return $this->products;
    }

}