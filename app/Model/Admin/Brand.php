<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Brand extends Model
{
	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'products.product_name'  => 10,
            'products.product_code'   => 10,
            'brands.brand_name'   => 10,
           
        ],
        'joins' => [
            'products' => ['brands.id','products.brand_id'],
        ],
    ];
    protected $fillable = [
            'brand_name', 'brand_logo','product_name','product_code'
        ];

    public function products()
    {
        return $this->hasMany('App\Product','brand_id');
    }    
}
