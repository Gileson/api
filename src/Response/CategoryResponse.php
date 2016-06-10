<?php
namespace Gileson\Api\Response;


use Gileson\Api\Models\Category;

class CategoryResponse extends Response {

    /**
     * @var null|Category
     */
    protected $category = null;

    /**
     * @return array
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param array $category
     *
     * @return $this
     */
    public function setCategory($category) {
        $this->category = Category::create($category);

        return $this;
    }

}