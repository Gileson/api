<?php
namespace Gileson\Api\Models;

/**
 * Class Category
 * @package Gileson\Api\Models
 * @property $id
 * @property $name
 * @property $slug
 * @property $order
 * @property $parent_id
 * @property $calc_name
 * @property $calc_slug
 */
class Category extends Model {

    protected $fields = [
        'id',
        'name',
        'slug',
        'order',
        'parent_id',
        'calc_name',
        'calc_slug'
    ];

}