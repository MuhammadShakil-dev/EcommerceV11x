<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Page;
use App\Models\Backend\SystemSetting;
use App\Models\Backend\ContactUs;
use App\Models\Backend\Slider;
use App\Models\Backend\Partner;
use App\Models\Backend\Category;
use App\Models\Backend\Product; 
use App\Models\Backend\Blog; 
use App\Models\Backend\BlogCategory; 
use App\Models\Backend\BlogComment; 
use App\Models\Backend\HomeSetting; 
use App\Models\User; 

use Auth;
use Mail;
use Session;
use App\Mail\ContactUsMail;

class HomeController extends Controller
{
    public function home()
    {
        // $data['meta_title'] = 'E-commerce';
        // $data['meta_description'] = '';
        // $data['meta_keywords'] = '';

        $getPage = Page::checkPageSlug('home');
        $data['getPage'] = $getPage;

        $data['getHomeSetting'] = HomeSetting::getSingle();

        $data['getBlog'] = Blog::getRecordActiveHome();
        $data['getSlider'] = Slider::getRecordActive();
        $data['getPartner'] = Partner::getRecordActive();
        $data['getCategoryHome'] = Category::getRecordActiveHome();
        $data['getProduct'] = Product::getRecentArrival();
        
        $data['getProductTrendy'] = Product::getProductTrendy();
        
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.home', $data);
    } 


    public function recentArrivalCategoryProduct(Request $request) 
    {
        // dd($request->all());
        $getProduct = Product::getRecentArrival();
        $getCategory = Category::getSingle($request->category_id);

        return response()->json([
            "status" => true,
            "success" => view("frontend.product._list_recen_atrrival",[
                "getProduct" => $getProduct,
                "getCategory" => $getCategory,
            ])->render(),
        ],200);
    }



    public function contact()
    {
        $first_number = mt_rand(0,9);
        $second_number = mt_rand(0,9);

        $data['first_number'] = $first_number;
        $data['second_number'] = $second_number;

        Session::put('total_sum', $first_number + $second_number);

        $getPage = Page::checkPageSlug('contact');
        $data['getPage'] = $getPage;
        $data['getSystemSetting'] = SystemSetting::getSingle();
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;


        return view('frontend.pages.contact', $data);
    }

    

    public function submitContact(Request $request) 
    {
        // dd($request->all());
        if(!empty($request->verification) && !empty(Session::get('total_sum')))
        {
            //
            if (trim(Session::get('total_sum')) ==trim($request->verification)) 
            {

                $save =  new ContactUs;

                if(!empty(Auth::check()))
                {
                    $save->user_id = Auth::user()->id;
                }

                $save->name =  trim($request->name);
                $save->email =  trim($request->email);
                $save->phone =  trim($request->phone);
                $save->subject =  trim($request->subject);
                $save->message =  trim($request->message);
                $save->save();

                // for email...
                // $getSystemSetting = SystemSetting::getSingle();
                 // Mail::to($getSystemSetting->submit_contact_email)->send(new ContactUsMail($save));

                return redirect()->back()->with('success',"Your information Successfully send");
            }
           else
           {

                return redirect()->back()->with('error',"Your verification sum is not match");
            }
        }
        else
        {
            //
            return redirect()->back()->with('error',"Your verification sum is not match");
        }

    }


    public function about()
    {
        $getPage = Page::checkPageSlug('about');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.about', $data);
    }

    public function faq()
    {
        $getPage = Page::checkPageSlug('faq');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.faq', $data);
    }

    public function paymentMethods()
    {
        $getPage = Page::checkPageSlug('payment-methods');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.payment_methods', $data);
    }


    public function moneyBackGuarantee()
    {
        $getPage = Page::checkPageSlug('money-back-guarantee');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.money_back_guarantee', $data);
    }

    public function returns()
    {
        $getPage = Page::checkPageSlug('returns');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.returns', $data);
    }

    public function shipping()
    {
        $getPage = Page::checkPageSlug('shipping');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.shipping', $data);
    }


    public function termsConditions()
    {
        $getPage = Page::checkPageSlug('terms-conditions');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.terms_conditions', $data);
    }


    public function privacyPolicy()
    {
        $getPage = Page::checkPageSlug('privacy-policy');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('frontend.pages.privacy_policy', $data);
    }


    public function blog()
    {
        $getPage = Page::checkPageSlug('blog');
        $data['getPage'] = $getPage;
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        $data['getBlog'] = Blog::getBlog();
        $data['getBlogCategory'] = BlogCategory::getRecordActive();
        $data['getPopular'] = Blog::getPopular();


        return view('frontend.blog.list', $data);
    }

    
    public function blogDetail($slug)
    {

        $getBlog  = Blog::getSingleSlug($slug);
        if(!empty($getBlog))
        {
            $total_view = $getBlog->total_view;
            $getBlog->total_view = $total_view + 1;
            $getBlog->save();

            $data['getBlog'] = $getBlog;
            $data['meta_title'] = $getBlog->meta_title;
            $data['meta_description'] = $getBlog->meta_description;
            $data['meta_keywords'] = $getBlog->meta_keywords;

            $data['getBlogCategory'] = BlogCategory::getRecordActive();
            $data['getPopular'] = Blog::getPopular();

            $data['getRelatedPost'] = Blog::getRelatedPost($getBlog->blog_category_id, $getBlog->id);
            return view('frontend.blog.detail', $data);
        }
        else
        {
            abort(404);
        }
        
    }

    

    public function blogCategory($slug)
    {

        $getCategory  = BlogCategory::getSingleSlug($slug);
        if(!empty($getCategory))
        {

            $data['getCategory'] = $getCategory;
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $data['getBlogCategory'] = BlogCategory::getRecordActive();
            $data['getPopular'] = Blog::getPopular();

            $data['getBlog'] = Blog::getBlog($getCategory->id);


            return view('frontend.blog.category', $data);
        }
        else
        {
            abort(404);
        }
        
    }

    public function submitBlogComment(Request $request)
    {
        // dd($request->all());

        
        $comment = new BlogComment;
        $comment->user_id = Auth::user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = trim($request->comment);
        $comment->save();

        return redirect()->back()->with('success',"Your Comment Successfully send");



    }


    // public function trackMyOrder()
    // {
    //     $data['meta_title'] = 'Track My Order';
    //     $data['meta_description'] = '';
    //     $data['meta_keywords'] = '';

    //     return view('frontend.pages.trackMyOrder', $data);
    // }


}
