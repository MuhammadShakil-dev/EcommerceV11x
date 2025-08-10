<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use App\Models\Backend\Product;
use App\Models\Backend\Color;
use App\Models\Backend\Brand;
use App\Models\Backend\ProductReview;
use Auth;


class ProductController extends Controller
{
    

    public function getCategoryAndSub($slug, $subslug = '')
    {
        $getProductSingle = Product::getSingleSlug($slug);
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subslug);
        $data['getColorFilter'] =  Color::getRecordActive();
        $data['getBrandFilter'] =  Brand::getRecordActive();

        if (!empty($getProductSingle))
        {
            // die;
            $data['meta_title'] = $getProductSingle->title;
            $data['meta_description'] = $getProductSingle->short_description;
            $data['getProduct'] = $getProductSingle;
            $data['getRelatedProduct']  = Product::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);
            $data['getProductReview']  = ProductReview::getProductReview($getProductSingle->id);


            return view('frontend.product.detail', $data);
        }

        else if (!empty($getCategory) && !empty($getSubCategory))
         {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);

            $page = 0;
             if (!empty($getProduct->nextPageUrl())) 
             {
                 $parse_url = parse_url($getProduct->nextPageUrl());
                  if(!empty($parse_url['query']))
                  {
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                  }
             }
             
            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            $data['getSubCategoryFilter'] =  SubCategory::getRecordSubCategory($getCategory->id);

            return view('frontend.product.list', $data);
         } 
        else if (!empty($getCategory)) 
        {
            $data['getSubCategoryFilter'] =  SubCategory::getRecordSubCategory($getCategory->id);

            // dd($data['getSubCategoryFilter']);

            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $getProduct = Product::getProduct($getCategory->id);

            $page = 0;
             if (!empty($getProduct->nextPageUrl())) 
             {
                 $parse_url = parse_url($getProduct->nextPageUrl());
                  if(!empty($parse_url['query']))
                  {
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                  }
             }

            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            return view('frontend.product.list', $data);
        }
        else
        {
            abort(404);
        }
    }



    

    public function getFilterProductAjax(Request $request)
    {
        $getProduct = Product::getProduct();

        $page = 0;
             if (!empty($getProduct->nextPageUrl())) 
             {
                 $parse_url = parse_url($getProduct->nextPageUrl());
                  if(!empty($parse_url['query']))
                  {
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                  }
             }
             
            // $data['page'] = $page;


        return response()->json([
            "status" => true,
            "page" => $page,
            "success" => view("frontend.product._list",[
                "getProduct" => $getProduct,
            ])->render(),
        ],200);


    }


    public function getSearchProduct(Request $request)
    {
        // echo "Tests_search 2";

        $data['meta_title'] = 'search';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $getProduct = Product::getProduct();
        $page = 0;
         if (!empty($getProduct->nextPageUrl())) 
         {
             $parse_url = parse_url($getProduct->nextPageUrl());
              if(!empty($parse_url['query']))
              {
                parse_str($parse_url['query'],$get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
              }
         }

        $data['page'] = $page;
        $data['getProduct'] = $getProduct;

        $data['getColorFilter'] =  Color::getRecordActive();
        $data['getBrandFilter'] =  Brand::getRecordActive();
        
        // $data['getCategory'] = $getCategory;
        // $data['getSubCategory'] = $getSubCategory;

        return view('frontend.product.list', $data);
    }


    // public function getSearchProduct(Request $request)
    // {

    //         // dd($request->all());
    //         $data['meta_title'] = 'search';
    //         $data['meta_description'] = '';
    //         $data['meta_keywords'] = '';

    //         $getProduct = Product::getProduct();
    //         $page = 0;
    //          if (!empty($getProduct->nextPageUrl())) 
    //          {
    //              $parse_url = parse_url($getProduct->nextPageUrl());
    //               if(!empty($parse_url['query']))
    //               {
    //                 parse_str($parse_url['query'],$get_array);
    //                 $page = !empty($get_array['page']) ? $get_array['page'] : 0;
    //               }
    //          }

    //         $data['page'] = $page;
    //         $data['getProduct'] = $getProduct;
    //         $data['getCategory'] = $getCategory;
    //         $data['getSubCategory'] = $getSubCategory;

    //         return view('frontend.product.list', $data);
    // }


    public function myWishlist()
    {
        $data['meta_title'] = 'My Wishlist';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getProduct']   = Product::getMyWishlist(Auth::user()->id);

        return view('frontend.product.my_wishlist', $data);

    }



}
