<?php
namespace Gileson\Api\Response;

use Gileson\Api\Collections\Categories;
use Gileson\Api\Collections\Category;

class CategoriesResponse extends Response {

    /**
     * @var array
     */
    protected $tree = [];
    /**
     * @var array
     */
    protected $flat_tree = [];
    /**
     * @var array|Categories
     */
    protected $categories = [];

    /**
     * @return array
     */
    public function getTree() {
        return $this->tree;
    }

    /**
     * @param array $tree
     *
     * @return $this
     */
    public function setTree($tree) {
        $this->tree = $tree;

        return $this;
    }

    /**
     * @return array
     */
    public function getFlatTree() {
        return $this->flat_tree;
    }

    /**
     * @param array $flat_tree
     *
     * @return $this
     */
    public function setFlatTree($flat_tree) {
        $this->flat_tree = $flat_tree;

        return $this;
    }

    /**
     * @return Categories
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * @param array $categories
     *
     * @return $this
     */
    public function setCategories($categories) {
        $this->categories = Categories::create($categories);
        return $this;
    }

}