<?php
namespace Gileson\Api\Response;

use Gileson\Api\Models\Product;

class ProductResponse extends Response {

    /**
     * @var Product
     */
    protected $product = null;

    /**
     * @return Product
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * @param array $product
     *
     * @return $this
     */
    public function setProduct($product) {
        $this->product = Product::create($product);

        return $this;
    }

}