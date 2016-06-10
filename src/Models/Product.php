<?php
namespace Gileson\Api\Models;

use Gileson\Api\Collections\Offers;

/**
 * Class Category
 * @package Gileson\Api\Models
 *
 * @property integer $id
 * @property boolean $is_wholesale
 * @property boolean $is_retail
 * @property string  $calc_code
 * @property integer $code_number
 * @property string  $external_id
 * @property boolean $is_master
 * @property integer $master_id
 * @property integer $status
 * @property boolean $is_disabled
 * @property string  $name
 * @property string  $description
 * @property string  $full_description
 * @property Offers  $offers
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
    ];

    function setOffers($offers) {
        $this->attributes['offers'] = Offers::create($offers);

        return $this;
    }

}