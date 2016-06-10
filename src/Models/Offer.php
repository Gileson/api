<?php
namespace Gileson\Api\Models;

/**
 * Class Category
 * @package Gileson\Api\Models
 *
 * @property integer            $id
 * @property integer            $product_id
 * @property string             $code
 * @property string             $property1_name
 * @property string             $property1_value
 * @property string             $property2_name
 * @property string             $property2_value
 * @property float              $price_0
 * @property float              $price_1
 * @property float              $price_yuan
 * @property float              $amount
 * @property boolean            $is_disabled
 * @property \Carbon\Carbon     $created_at
 * @property \Carbon\Carbon     $updated_at
 * @property string             $deleted_at
 * @property-read mixed         $name
 * 
 */
class Offer extends Model {

    protected $fields = [
        'id',
        'product_id',
        'code',
        'property1_name',
        'property1_value',
        'property2_name',
        'property2_value',
        'price_0',
        'price_1',
        'price_yuan',
        'amount',
        'is_disabled',
        'name',
        'product'
    ];

    function setProduct($product){
        $this->attributes['product'] = Product::create($product);
    }

}