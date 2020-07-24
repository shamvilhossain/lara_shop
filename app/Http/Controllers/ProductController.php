<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Model\Admin\Brand;
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

    public function CategoryProduct($id,$category_name)
    {
        $limit=9; $sort_val=1; $sort_by='products.id'; $sort_order='DESC';

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['sort_val'])){
            $sort_val = $_GET['sort_val'];
            if($sort_val==2){
                $sort_by='products.product_name'; $sort_order='ASC';
            }elseif($sort_val==3){
                $sort_by='products.selling_price'; $sort_order='DESC';
            }elseif($sort_val==4){
                $sort_by='products.selling_price'; $sort_order='ASC';
            }
        }
        $category_id= $id; // actually category_id
        $products = DB::table('products')
                     ->join('categories','products.category_id','=','categories.id')
                     ->select('products.*','categories.category_name')
                     ->where('products.category_id',$id)
                     ->where('products.status',1)
                     ->orderBy($sort_by,$sort_order)
                     ->paginate($limit); 
        $brands= DB::table('products')
                ->join('brands','products.brand_id','=','brands.id')
                ->select('products.brand_id','brands.brand_name')
                ->where('products.category_id',$id)
                ->groupBy('products.brand_id','brands.brand_name')->get();
        $categories= DB::table('categories')->get(); 
        $latest_product=DB::table('products')
                                 ->where('status',1)
                                 ->latest()
                                 ->limit(3)
                                 ->get();        
         
        return view('pages.category_products',compact('products','brands','categories','category_id','limit','sort_val','latest_product'));
    }

    public function SubCategoryProduct($id)
    {
        $limit=9; $sort_val=1; $sort_by='products.id'; $sort_order='DESC';

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['sort_val'])){
            $sort_val = $_GET['sort_val'];
            if($sort_val==2){
                $sort_by='products.product_name'; $sort_order='ASC';
            }elseif($sort_val==3){
                $sort_by='products.selling_price'; $sort_order='DESC';
            }elseif($sort_val==4){
                $sort_by='products.selling_price'; $sort_order='ASC';
            }
        }
        $subcategory_id= $id;
        $products = DB::table('products')
                     ->join('categories','products.category_id','=','categories.id')
                     ->join('subcategories','products.subcategory_id','=','subcategories.id')
                     ->select('products.*','categories.category_name','subcategories.subcategory_name')
                     ->where('products.subcategory_id',$id)
                     ->where('products.status',1)
                     ->orderBy($sort_by,$sort_order)
                     ->paginate($limit); 
        $brands= DB::table('products')
                ->join('brands','products.brand_id','=','brands.id')
                ->select('products.brand_id','brands.brand_name')
                ->where('products.subcategory_id',$id)
                ->groupBy('products.brand_id','brands.brand_name')->get();
        $categories= DB::table('categories')->get();   
        $latest_product=DB::table('products')
                                 ->where('status',1)
                                 ->latest()
                                 ->limit(3)
                                 ->get(); 
        return view('pages.subcat_products',compact('products','brands','categories','subcategory_id','limit','sort_val','latest_product'));
    }

    public function AllProduct($type=null)
    {
        $limit=9; $sort_val=1; $sort_by='products.id'; $sort_order='DESC';

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['sort_val'])){
            $sort_val = $_GET['sort_val'];
            if($sort_val==2){
                $sort_by='products.product_name'; $sort_order='ASC';
            }elseif($sort_val==3){
                $sort_by='products.selling_price'; $sort_order='DESC';
            }elseif($sort_val==4){
                $sort_by='products.selling_price'; $sort_order='ASC';
            }elseif($sort_val==5){
                $sort_by='products.view_count'; $sort_order='DESC';
            }
        }
        if($type=='featured'){
            $products = DB::table('products')
                     ->join('categories','products.category_id','=','categories.id')
                     ->select('products.*','categories.category_name')
                     ->where('products.status',1)
                     ->where('products.featured',1)
                     ->orderBy($sort_by,$sort_order)
                     ->paginate($limit); 
        }else{
            $products = DB::table('products')
                     ->join('categories','products.category_id','=','categories.id')
                     ->select('products.*','categories.category_name')
                     ->where('products.status',1)
                     ->orderBy($sort_by,$sort_order)
                     ->paginate($limit);
        }
        
        $brands= DB::table('products')
                ->join('brands','products.brand_id','=','brands.id')
                ->select('products.brand_id','brands.brand_name')
                ->groupBy('products.brand_id','brands.brand_name')->get();
        $categories= DB::table('categories')->get();   
        $latest_product=DB::table('products')
                                 ->where('status',1)
                                 ->latest()
                                 ->limit(3)
                                 ->get(); 
        return view('pages.all_products',compact('products','brands','categories','limit','sort_val','latest_product','type'));
    }

    function search_action(Request $request)
    {
        $this->validate(request(), [
            'full_text_search' => 'required|min:3',
        ]);
        $full_text_search_string = $request->input('full_text_search');
//        Column not found: 1054 Unknown column 'categories.category_name' in 'field list' 
//        (SQL: select * from (select `products`.*, max((case when LOWER(`products`.`product_name`) 
//         LIKE jacket then 150 else 0 end) + (case when LOWER(`products`.`product_name`) LIKE jacket% 
//         then 50 else 0 end) + (case when LOWER(`products`.`product_name`) 
//         LIKE %jacket% then 10 else 0 end) + (case when LOWER(`products`.`product_code`) 
//         LIKE jacket then 150 else 0 end) + (case when LOWER(`products`.`product_code`) 
//         LIKE jacket% then 50 else 0 end) + (case when LOWER(`products`.`product_code`) 
//         LIKE %jacket% then 10 else 0 end) + (case when LOWER(`categories`.`category_name`) 
//         LIKE jacket then 150 else 0 end) + (case when LOWER(`categories`.`category_name`) 
//         LIKE jacket% then 50 else 0 end) + (case when LOWER(`categories`.`category_name`) 
//         LIKE %jacket% then 10 else 0 end) + (case when LOWER(`brands`.`brand_name`) 
//         LIKE jacket then 150 else 0 end) + (case when LOWER(`brands`.`brand_name`) 
//         LIKE jacket% then 50 else 0 end) + (case when LOWER(`brands`.`brand_name`) 
//         LIKE %jacket% then 10 else 0 end)) as relevance from `products` group by 
// `products`.`id` having relevance >= 10.00 order by `relevance` desc) as `products`) 
// in file I:\xampp\htdocs\lara_shop\vendor\laravel\framework\src\Illuminate\Database\Connection.php on 
// line 665

    DB::enableQueryLog();
    $data = Product::search($full_text_search_string)->with('brands')->paginate(12);
    $quries = DB::getQueryLog(); // to print loast query

    $products = $data;
    return view('pages.search_products',compact('products','full_text_search_string'));
   
    }
}
