<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use App\Models\Backend\Product; 
use App\Models\Backend\Brand; 
use App\Models\Backend\Color;
use App\Models\Backend\ProductColor;
use App\Models\Backend\ProductSize;
use App\Models\Backend\ProductImage;
use Auth;
use Str;


class ProductController extends Controller
{
    
    public function listProduct()
    {
        $data['getRecord'] = Product::getRecord();
        $data['header_title'] = "Product";
        return view('backend.product.list',$data);
    }


    public function addProduct()
    {
        $data['header_title'] = "Add New Product";
        return view('backend.product.add',$data);
    }


    public function insertProduct(Request $request) 
    {
        // dd($request->all());

        $title =  trim($request->title);
        $product = new Product;
        $product->title =  $title;
        $product->created_by = Auth::user()->id; 
        $product->save();

        $slug = Str::slug($title, "-");
        
        $checkSlug = Product::checkSlug($slug);
         if (empty($checkSlug))
         {
            $product->slug =  $slug;
            $product->save();
         }
         else
         {
            $newSlug=  $slug.'-' .$product->id;
            $product->slug =  $newSlug;
            $product->save();
         }

        return redirect('products/product/edit/'.$product->id);   

    }


    public function editProduct($product_id) 
    {
    
      $product = Product::getSingle($product_id);
         if (!empty($product))
         {
            $data['getCategory'] = Category::getRecordActive();
            $data['getBrand'] = Brand::getRecordActive();
            $data['getColor'] = Color::getRecordActive();
            $data['product'] = $product;

            $data['getSubCategory'] =  SubCategory::getRecordSubCategory($product->category_id);
             

            $data['header_title'] = "Edit Product";
            return view('backend.product.edit',$data);
         }

    }


    public function updateProduct($product_id, Request $request) 
    {
        
        $product = Product::getSingle($product_id);
         if (!empty($product))
         {
            
           // dd($request->all());


            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            // $product->color_id = trim($request->color_id);
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);

            $product->is_trendy = !empty($request->is_trendy) ? 1 : 0;

            $product->status = trim($request->status);
            $product->save();

             ProductColor::deleteRecord($product->id); 
             if (!empty($request->color_id))
              {
                foreach($request->color_id as $color_id)
                {
                    $color = new ProductColor;
                    $color->color_id = $color_id;
                    $color->product_id = $product->id;
                    $color->save();
                }
              }

             ProductSize::deleteRecord($product->id);
              if (!empty($request->size))
               {
                 foreach($request->size as $size)
                 {
                    if (!empty($size['name']))
                     {
                        $product_size = new ProductSize;
                        $product_size->name = $size['name'];
                        $product_size->price = !empty($size['price']) ? $size['price'] : 0;
                        $product_size->product_id = $product->id;
                        $product_size->save();
                     }
                 }
               }


               // images
               if (!empty($request->file('image')))
               {
                 foreach ($request->file('image') as $value)
                 {
                      // print_r($value);
                     // echo "*********";
                      if ($value->isValid()) 
                      {
                         // echo $ext = $value->getClientOriginalExtension();
                         $ext = $value->getClientOriginalExtension();
                         // echo "<br>";
                         // $file = $value;
                         // $randomStr = date('Ymdhis').Str::random(10);
                         $randomStr = $product->id.Str::random(20);
                         $filename = strtolower($randomStr).'.'.$ext;
                         $value->move('public/upload/product/', $filename);


                         $imageUpload = new ProductImage;
                         $imageUpload->image_name = $filename;
                         $imageUpload->image_extension = $ext;
                         $imageUpload->product_id = $product->id;
                         $imageUpload->save();
                       }
                    }
                }


            return redirect()->back()->with('success',"Product Successfully Updated");

         }
         else
         {
            aborta(404);
         }
    }



    
    public function deleteProductImage($id) 
    {

        $image = ProductImage::getSingle($id);
        if(!empty($image->getImageLog()))
        {
            unlink('public/upload/product/'.$image->image_name);
        }
        $image->delete();

        return redirect()->back()->with('deleting',"Product image Successfully Deleted");
    }
    


    public function sortableProductImage(Request $request) 
    {
        // dd($request->all());
        if (!empty($request->photo_id))
        {
            $i = 1;
            foreach ($request->photo_id as $photo_id)
            {
                $image = ProductImage::getSingle($photo_id);
                $image->order_by = $i;
                $image->save();

                $i++;
            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    
}
