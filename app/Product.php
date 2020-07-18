<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'products.product_name'  => 10,
            'products.product_code'   => 10,
            //'products.product_details'   => 10,
            //'categories.category_name'   => 2,
            'brands.brand_name'   => 10,
           
        ],
        // 'joins' => [
        //     'categories' => ['products.category_id','categories.id'],
        // ],
        'joins' => [
            'brands' => ['products.brand_id','brands.id'],
        ],
    ];

    

    // public function categories()
    // {
    //     return $this->hasOne('App\Model\Admin\Category','id');
    // }

    // public function brands()
    // {	
    // 	// Eloquent will try to match the post_id from the Comment model to an id on the Post model. 	
    // 	// However, if the foreign key on the Comment model is not post_id, 
    // 	// you may pass a custom key name as the second argument to the hasOne method
    //     return $this->belongsTo('App\Model\Admin\Brand','id');
    // }

	public function brands(){   
	    return $this->belongsTo('App\Model\Admin\Brand','brand_id');
	}
	public function product(){   
	    return $this->belongsTo('App\Product','id');
	}

    protected $fillable = [
        'product_name', 'product_code','brand_name'  
    ];
}
