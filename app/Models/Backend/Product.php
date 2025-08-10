<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Auth;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    static public function checkSlug($slug)
    {
        return self::where('slug',  '=', $slug)->count();
    }

    static public function getSingle($id)
    {
        return self::find($id); 
    }

    static public function getRecord()
    {
        // join Qu
        return self::select('products.*', 'users.name as created_by_name')
                     ->join('users', 'users.id', '=', 'products.created_by')
                     ->where('products.is_delete',  '=', 0)
                     ->orderBy('products.id', 'desc')
                     ->paginate(20);

    }


    public function getColor()
    {
        return $this->hasMany(ProductColor::class, "product_id"); 
    }


    public function getSize()
    {
        return $this->hasMany(ProductSize::class, "product_id"); 
    }


    public function getImage()
    {
        return $this->hasMany(ProductImage::class, "product_id")->orderBy('order_by', 'asc'); 
    }



    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $return = self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as category_slug', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug')
                     ->join('users', 'users.id', '=', 'products.created_by')

                     ->join('categories', 'categories.id', '=', 'products.category_id')
                     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id');


                     if (!empty($category_id))
                     {
                         $return = $return->where('products.category_id',  '=', $category_id);
                     }

                     if (!empty($subcategory_id))
                     {
                         $return = $return->where('products.sub_category_id',  '=', $subcategory_id);
                     }
                      
                      // Filter by category
                     if (!empty(Request::get('sub_category_id')))
                     {
                         $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
                         $sub_category_id_arry =  explode(",", $sub_category_id); 
                         $return = $return->whereIn('products.sub_category_id', $sub_category_id_arry);

                         // dd($sub_category_id);
                     }
                     else
                     {
                        
                        if (!empty(Request::get('old_category_id')))
                        {
                           $return = $return->where('products.category_id',  '=', Request::get('old_category_id'));
                        }

                        if (!empty(Request::get('old_sub_category_id')))
                        {
                           $return = $return->where('products.sub_category_id',  '=', Request::get('old_sub_category_id'));
                        }

                     }

                      
                      // Filter by color
                     if (!empty(Request::get('color_id')))
                     {
                         $color_id = rtrim(Request::get('color_id'), ',');
                         $color_id_arry =  explode(",", $color_id);
                         $return = $return->join('product_colors', 'product_colors.product_id', '=', 'products.id');
                         $return = $return->whereIn('product_colors.color_id', $color_id_arry);

                         // dd($color_id);
                     }
                      

                      // Filter by brand
                     if (!empty(Request::get('brand_id')))
                     {
                         $brand_id = rtrim(Request::get('brand_id'), ',');
                         $brand_id_arry =  explode(",", $brand_id); 
                         $return = $return->whereIn('products.brand_id', $brand_id_arry);
                         // dd($brand_id);
                     }

                     
                      // Filter by price
                     if (!empty(Request::get('start_price')) &&  !empty(Request::get('end_price')))
                      {
                        $start_price = str_replace('$','', Request::get('start_price'));
                        $end_price = str_replace('$','', Request::get('end_price'));

                        $return = $return->where('products.price',  '>=', $start_price);
                        $return = $return->where('products.price',  '<=', $end_price);
                      }  


                      // Search
                     if (!empty(Request::get('q')))
                     {
                        $return = $return->where('products.title',  'like', '%'.Request::get('q').'%');

                     }

                     $return = $return->where('products.is_delete',  '=', 0)
                     ->where('products.status',  '=', 0)
                     ->groupBy('products.id')
                     ->orderBy('products.id', 'desc')
                     ->paginate(20);

         return $return;            
    }


    static public function getImageSingleFront($product_id)
    {
        return ProductImage::where('product_id', '=', $product_id)->orderBy('order_by', 'asc')->first(); 
    }


    static public function getSingleSlug($slug)
    {
        return self::where('slug',  '=', $slug)
                     ->where('products.status',  '=', 0)
                     ->where('products.is_delete',  '=', 0)
                     ->first();
    }



    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    

    static public function getRelatedProduct($product_id, $sub_category_id)
    {

        $return = self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as category_slug', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug')
                     ->join('users', 'users.id', '=', 'products.created_by')
                     ->join('categories', 'categories.id', '=', 'products.category_id')
                     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
                     ->where('products.id',  '!=', $product_id)
                     ->where('products.sub_category_id',  '=', $sub_category_id)
                     ->where('products.status',  '=', 0)
                     ->groupBy('products.id')
                     ->orderBy('products.id', 'desc')
                     ->limit(10)
                     ->get();

         return $return;             
    }


    public function checkWishlist($product_id)
    {

        return ProductWishlist::checkAlready($product_id, Auth::user()->id);

    }


    static public function getMyWishlist($user_id)
    {
        $return = self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as category_slug', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug')
                     ->join('users', 'users.id', '=', 'products.created_by')

                     ->join('categories', 'categories.id', '=', 'products.category_id')
                     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
                     ->join('product_wishlists', 'product_wishlists.product_id', '=', 'products.id')
                     ->where('product_wishlists.user_id',  '=', $user_id)
                     ->where('products.is_delete',  '=', 0)
                     ->where('products.status',  '=', 0)
                     ->groupBy('products.id')
                     ->orderBy('products.id', 'desc')
                     ->paginate(20);

         return $return;            
    }


    public function getTotalReview()
    {
        return $this->hasMany(ProductReview::class, 'product_id')
                    ->join('users', 'users.id', 'product_reviews.user_id')
                    ->count();
    }

    
    public function getReviewRating($product_id)
    {
        $avg = ProductReview::getProductRatingAvg($product_id);

        if($avg >=1 && $avg <=1)
        {
            return 20;
        }
        else if($avg >=1 && $avg <=2)
        {
            return 40;
        }
        else if($avg >=1 && $avg <=3)
        {
            return 60;
        }
        else if($avg >=1 && $avg <=4)
        {
            return 80;
        }
        else if($avg >=1 && $avg <=5)
        {
            return 100;
        }
        else
        {
            return 0;
        }
    }



    static public function getRecentArrival()
     {
        $return = self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as category_slug', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug')
                     ->join('users', 'users.id', '=', 'products.created_by')
                     ->join('categories', 'categories.id', '=', 'products.category_id')
                     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
                     ->where('products.is_delete',  '=', 0)
                     ->where('products.status',  '=', 0);
                     if (!empty(Request::get('category_id')))
                     {
                         $return = $return->where('products.category_id',  '=', Request::get('category_id'));

                     }

           $return = $return->groupBy('products.id')
                     ->orderBy('products.id', 'desc')
                     ->limit(8)
                     ->get();

        return $return; 

     }


     
     static public function getProductTrendy()
     {
        $return = self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as category_slug', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug')
                     ->join('users', 'users.id', '=', 'products.created_by')
                     ->join('categories', 'categories.id', '=', 'products.category_id')
                     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
                     ->where('products.is_trendy',  '=', 1)
                     ->where('products.is_delete',  '=', 0)
                     ->where('products.status',  '=', 0)
                     ->groupBy('products.id')
                     ->orderBy('products.id', 'desc')
                     ->limit(15)
                     ->get();

        return $return; 

     }
        

}
