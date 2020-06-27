<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
    public function ProductView($product_id,$product_name)
    {
        $product_info = DB::table('products')
                                 ->join('brands','products.brand_id','=','brands.id')
                                 ->join('categories','products.category_id','=','categories.id')
                                 ->select('products.*','brands.brand_name','categories.category_name')
                                 ->where('products.id',$product_id)
                                 ->where('products.status',1)
                                 ->first();
        $product_colors= explode(',', $product_info->product_color);                         
                                
        //update view count
        DB::table('products')
                     ->where('id',$product_info->id)
                     ->increment('view_count', 1);

        // related product                        
        $related_product_info = DB::table('products')
                                 ->join('brands','products.brand_id','=','brands.id')
                                 ->join('categories','products.category_id','=','categories.id')
                                 ->select('products.*','brands.brand_name','categories.category_name')
                                 ->where('products.id','<>', $product_info->id)
                                 ->where('products.category_id',$product_info->category_id)
                                 ->where('products.status',1)
                                 ->get();                      
        return view('pages.product_details',compact('product_info','related_product_info','product_colors'));
                
    }

    public function SubCategoryProduct($id)
    {
        //$products=DB::table('products')->where('subcategory_id',$id)->get();
        $products = DB::table('products')
                     ->join('categories','products.category_id','=','categories.id')
                     ->join('subcategories','products.subcategory_id','=','subcategories.id')
                     ->select('products.*','categories.category_name','subcategories.subcategory_name')
                     ->where('products.subcategory_id',$id)
                     ->where('products.status',1)
                     ->paginate(12); 
        $brands= DB::table('products')
                ->join('brands','products.brand_id','=','brands.id')
                ->select('products.brand_id','brands.brand_name')
                ->where('products.subcategory_id',$id)
                ->groupBy('products.brand_id','brands.brand_name')->get();
         
        return view('pages.all_products',compact('products','brands'));
    }
}
