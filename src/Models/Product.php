<?php
namespace Gileson\Api\Models;

use Gileson\Api\Collections\Categories;
use Gileson\Api\Collections\Offers;
use Gileson\Api\Collections\ProductImages;

/**
 * Class Category
 * @package Gileson\Api\Models
 *
 * @property integer       $id
 * @property boolean       $is_wholesale
 * @property boolean       $is_retail
 * @property string        $calc_code
 * @property integer       $code_number
 * @property string        $external_id
 * @property boolean       $is_master
 * @property integer       $master_id
 * @property integer       $status
 * @property boolean       $is_disabled
 * @property string        $name
 * @property string        $description
 * @property string        $full_description
 * @property Offers        $offers
 * @property string        $property1_name
 * @property string        $property2_name
 * @property ProductImages $images
 *
 */
class Product extends Model {

    protected $fields = [
        'id',
        'is_wholesale',
        'is_retail',
        'code',
        'external_id',
        'is_master',
        'master_id',
        'status',
        'is_disabled',
        'name',
        'description',
        'full_description',
        'offers',
        'property1_name',
        'property2_name',
        'categories',
        'images',
        'description_retail',
        'full_description_retail',
        'main_photo_id',
    ];

    function setOffers($offers) {
        $this->attributes['offers'] = Offers::create($offers);

        return $this;
    }

    function setCategories($categories) {
        $this->attributes['categories'] = Categories::create($categories);

        return $this;
    }

    function setImages($images) {
        $this->attributes['images'] = ProductImages::create($images);

        return $this;
    }

}