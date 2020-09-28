<?php

namespace App\Http\Controllers\Front;

use App\Attribute;
use App\Banner;
use App\Brand;
use App\Category;
use App\Club;
use App\Contact;
use App\Feature;
use App\Gallery;
use App\Post_comments;
use App\Postcategory;
use App\Attribute_product;
use App\Setting;
use App\Slider;
use App\User;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Comment;
use function Cassandra\Type;


class FrontController extends Controller
{
    public function index()
    {

        $products_new = Product::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(12)->get();
        $products_view = Product::where('status', 'PUBLISHED')->orderby('view', 'desc')->take(4)->get();
        $products_discount = Product::where('status', 'PUBLISHED')->where('discount', '!=', '0')->take(11)->get();
        $spacial_product = Product::where(['special' => 'YES', 'status' => 'PUBLISHED'])->orderby('id', 'desc')->take(4)->get();
        $sale_product =Product::where('status', 'PUBLISHED')->orderby('sale', 'desc')->take(8)->get();
        $categories_image = Category::where('showindex', 'YES')->get();
        $categories = Category::where('parent', '0')->get();

        $posts = Post::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(8)->get();
        $sliders = Slider::where('status', 'Show')->get();
        $banners = Banner::where('status', 'Show')->get();
        $brands = Brand::where('status', 'Show')->get();

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        $title=$setting['title'];
        $seo_title=$setting['seo_title'];
        $seo_content=$setting['seo_content'];

        return view('front'.theme_name().'index.index', compact('title','seo_title','seo_content','categories_image', 'categories', 'products_new', 'products_view', 'spacial_product', 'products_discount','sale_product', 'posts', 'sliders', 'banners', 'setting','brands'));
    }

    public function blog_index()
    {
        @$cat = $_GET['cat'];

        if ($cat) {
            $posts = Post::whereHas('postcategories', function ($q) use ($cat) {
                $q->where('postcategories.slug', $cat);
            })->paginate(10);
        } else {
            $posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderby('id', 'desc')->paginate(10);
        }
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(2)->get();
        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(2)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(2)->get();
        $categories = Postcategory::all();

        $title="مقالات";
        $seo_title="سئو مقالات";
        $seo_content="سئو مقالات";

        return view('front'.theme_name().'blog.index', compact('title','seo_title','seo_content','posts', 'categories', 'posts_rand','last_posts','posts_view'));
    }

    public function blog($slug)
    {
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(3)->get();
        $categories = Postcategory::all();

        $post = Post::where(['status' => 'PUBLISHED', 'slug' => $slug])->with('postcategories')->first();

        $comments=Post_comments::where(['post_id'=>$post->id,'status'=>'SEEN','parent'=>'0'])->get();

        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(4)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(2)->get();

        $like_posts = collect([]);
        foreach ($post->postcategories as $val) {
            $category_posts = $val->post;
            foreach ($category_posts as $post2) {
                if ($post->id != $post2->id) {
                    if (!$like_posts->contains('id', $post2->id)) {
                        $like_posts->push($post2);
                    }
                }

            }
        }

        $title=$post->title;
        $seo_title=$post->seoTitle;
        $seo_content=$post->seoContent;
        return view('front'.theme_name().'blog.show', compact('title','seo_title','seo_content','post', 'categories', 'posts_rand','last_posts', 'posts_view','comments','like_posts'));
    }

    public function blog_search()
    {
        $title = Input::get('title');
        $posts = Post::where('status', 'PUBLISHED')->where('title', 'like', "%" . $title . "%")->with('postcategories')->orderby('id', 'desc')->paginate(6);
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(3)->get();
        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(4)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(4)->get();
        $categories = Postcategory::all();
        $title="جستجو".$title." | مقالات";
        $seo_title="سئو مقالات";
        $seo_content="سئو مقالات";

        return view('front'.theme_name().'blog.index', compact('title','seo_title','seo_content','posts', 'categories', 'posts_rand','last_posts','posts_view'));
    }
    public function comment_post(Request $request)
    {
        $comment=new Post_comments();
        $comment->name=$request->name;
        $comment->content=$request->input('content');
        $comment->user_id=Auth::id();
        $comment->post_id=$request->post;
        $comment->email=$request->email;
        $comment->save();
        session()->put('save_comment','نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        return redirect()->back();
    }

    public function contact()
    {
        $options = Setting::all();
        $brands = Brand::where('status', 'Show')->get();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        $title="تماس باما";
        $seo_title="سئو تماس باما";
        $seo_content="سئو تماس باما";
        return view('front'.theme_name().'contact.index', compact(['title','seo_title','seo_content','setting','brands']));
    }

    public function shop()
    {
        @$cat = $_GET['cat'];

        if ($cat) {
            $productItems = Product::whereHas('categories', function ($q) use ($cat) {
                $q->where('categories.slug', $cat);
            })->paginate(20);
        } else {
            $productItems = Product::where('status', 'PUBLISHED')->with('categories')->orderby('id', 'desc')->paginate(20);
        }
        $spacial_product = Product::where(['special' => 'YES', 'status' => 'PUBLISHED'])->orderby('id', 'desc')->take(6)->get();

        $sales=Product::where('status','PUBLISHED')->orderby('sale','desc')->take(6)->get();
        $categories = Category::where('parent','0')->get();
        $products_new = Product::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(11)->get();
        $products_discount = Product::where('status', 'PUBLISHED')->where('discount', '!=', '0')->take(11)->get();
        $attributes = Attribute::with('attribute_values')->where('inshop', 'YES')->get();

        $title="فروشگاه";
        $seo_title="سئو فروشگاه";
        $seo_content="سئو فروشگاه";
        return view('front'.theme_name().'shop.index', compact('title','seo_title','seo_content','productItems', 'categories', 'products_new', 'products_discount', 'attributes','sales','spacial_product'));
    }

    public function product($slug)
    {
        $product = Product::where(['slug' => $slug])->first();
        $images = Gallery::where(['product_id' => $product->id, 'type' => 'product'])->get();
        $featurs = Feature::where('product_id', $product->id)->get();
        $comments=Comment::where(['product_id'=>$product->id,'status'=>'SEEN','parent'=>'0'])->with('user')->get();
        $sales=Product::where('status','PUBLISHED')->orderby('sale','desc')->take(7)->get();
        $spacial_product = Product::where(['special' => 'YES', 'status' => 'PUBLISHED'])->orderby('id', 'desc')->take(6)->get();
        $like_products = collect([]);
        foreach ($product->categories as $val) {
            $category_products = $val->products;
            foreach ($category_products as $product2) {
                if ($product->id != $product2->id) {
                    if (!$like_products->contains('id', $product2->id)) {
                        $like_products->push($product2);
                    }
                }

            }
        }
        $categories = Category::where('parent', '0')->get();


        $title=$product->title;
        $seo_title=$product->title_seo;
        $seo_content=$product->meta_description;
        return view('front'.theme_name().'shop.show', compact('title','seo_title','seo_content','product', 'categories', 'images', 'like_products', 'featurs','comments','sales','spacial_product'));
    }

    public function comment_product(Request $request)
    {
        $comment=new Comment();
        $comment->title=$request->title;
        $comment->content=$request->input('content');
        $comment->user_id=Auth::id();
        $comment->product_id=$request->pro;
        $comment->rating=$request->rating;
        $comment->save();
        session()->put('save_comment','نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        return redirect()->back();
    }

    public function cart()
    {
        $user = User::find(Auth::id());

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }

            $title="سبد خرید";
            $seo_title="سئو برسی و پرداخت";
            $seo_content="سئو برسی و پرداخت";
            return view('front'.theme_name().'shop.cart', compact(['title','seo_title','seo_content','user','setting']));


    }

    public function checkout()
    {
        $user = User::find(Auth::id());

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        if (Auth::check()) {
            $title="برسی و پرداخت";
            $seo_title="سئو برسی و پرداخت";
            $seo_content="سئو برسی و پرداخت";
            return view('front'.theme_name().'shop.checkout', compact(['title','seo_title','seo_content','user','setting']));
        } else {
            return redirect('/login');
        }

    }

    public function productAttrVal()
    {
        $attribute_products = Attribute_product::all();
        $productAttrVal = [];
        foreach ($attribute_products as $row) {
            $productId = $row['product_id'];
            $attrId = $row['attribute_id'];
            $attrValueId = $row['attribute_value_id'];
            if (!isset($productAttrVal[$productId])) {
                $productAttrVal[$productId] = [];
            }
            $productAttrVal[$productId][$attrId] = $attrValueId;
        }

        return $productAttrVal;
    }

    public function doSearch(Request $request)
    {
        $productAttrVal = $this->productAttrVal();


        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 21;
        }
        if ($request->sort) {

            if ($request->sort == "new") {
                $sort1 = 'id';
                $sort2 = 'desc';
            }
            if ($request->sort == "sell") {
                $sort1 = 'sale';
                $sort2 = 'desc';
            }
            if ($request->sort == "view") {
                $sort1 = 'view';
                $sort2 = 'desc';
            }
            if ($request->sort == "priceLow") {
                $sort1 = 'price';
                $sort2 = 'desc';
            }
            if ($request->sort == "priceHigh") {
                $sort1 = 'price';
                $sort2 = 'asc';
            }

        }

        $minamount=0;
        if ($request->minamount){
            if ($request->minamount!="NaN"){
                $minamount=trim($request->minamount);
            }else{
                $minamount=0;
            }

        }
        $maxamount=500000000;
        if ($request->minamount){
            if ($request->minamount!='NaN'){
                $maxamount=trim($request->maxamount);
            }else{
                $maxamount=500000000;
            }

        }

        $products = Product::where([['status','PUBLISHED'],['price','>',$minamount],['price','<',$maxamount]])->orderby($sort1, $sort2)->paginate($limit);

        $productTotal = [];

        // $data=['attr-3'=>['10','11'],'attr-4'=>'1'];

        if ($request->dataval) {
            foreach ($products as $productKey => $product) {

                foreach ($request->dataval as $key => $arrayValId) {

                    $attr = explode('-', $arrayValId['name']);
                    $attrId = $attr[1];
                    $attrId = explode('[', $attrId);
                    /*$attr = explode('-', $key);
                    @$attrId = $attr[1];
                    @$productVal = $productAttrVal[$product->id][$attrId];*/

                    @$productVal = $productAttrVal[$product->id][$attrId[0]];

                    if (isset($productVal)) {
                        if (!in_array($productVal, $arrayValId)) {
                            unset($products[$productKey]);
                        }
                    }
                }
            }
        }

        /* return response([
             'msg'=>$products
         ]);*/
        if (count($products)){
            foreach ($products as $item) {
                ?>
                <div class="col-md-4 col-sm-6 col-xl-3">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="/product/<?=$item->slug?>"><img src="<?=asset($item->image)?>" alt="<?=$item->title?>"></a>
                                <?php if($item->discount>0){?>
                                <div class="label_product">
                                    <span class="label_sale"><?=$item->discount?>%</span>
                                </div>
                                <?php } ?>
                                <div class="action_links">
                                    <ul>
                                        <?php
                                        $favorite=Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first();

                                        if(empty($favorite)){?>
                                        <li class="wishlist"><a onclick="favorite(this,<?=$item->id?>)" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                        <?php }else{ ?>
                                        <li class="wishlist"><a style="color: red" onclick="favorite(this,<?=$item->id?>)" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                        <?php } ?>
                                        <li class="quick_button">
                                            <a href="/product/<?=$item->slug?>" title="مشاهده "> <span class="ion-ios-search-strong"></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add_to_cart">
                                    <?php if($item->depot>0){?>
                                    <a style="color: #fff" onclick="addcart(this,'<?=$item->id?>')" title="افزودن به سبد">افزودن به سبد</a>
                                     <?php }else{ ?>
                                    <a style="color: #fff" title="ناموجود">ناموجود</a>
                                     <?php } ?>
                                </div>
                            </div>
                            <div class="product_content grid_content">
                                <div class="price_box">
                                    <?php if($item->discount>0){?>
                                    <span class="old_price"><?=number_format($item->price)?> تومان</span>
                                    <span class="current_price"><?=number_format($item->price*(100-$item->discount)/100)?> تومان</span>
                                    <?php }else{ ?>
                                    <span style="height: 53px;line-height: 53px;" class="current_price"><?=number_format($item->price)?> تومان</span>
                                    <?php } ?>
                                </div>
                                <h3 class="product_name grid_name"><a href="/product/<?=$item->slug?>"><?=str_limit($item->title,50)?></a></h3>

                            </div>
                            <div class="product_content list_content">
                                <div class="left_caption">
                                    <div class="price_box">
                                        <?php if($item->discount>0){?>
                                        <span class="old_price"><?=number_format($item->price)?> تومان</span>
                                        <span class="current_price"><?=number_format($item->price*(100-$item->discount)/100)?> تومان</span>
                                        <?php }else{ ?>
                                        <span style="height: 53px;line-height: 53px;" class="current_price"><?=number_format($item->price)?> تومان</span>
                                     <?php } ?>
                                    </div>
                                    <h3 class="product_name"><a href="/product/<?=$item->slug?>"><?=str_limit($item->title,120)?></a></h3>
                                    <div class="product_desc">
                                        <p><?=str_limit($item->excerpt,200)?></p>
                                    </div>
                                </div>
                                <div class="right_caption">
                                    <div class="add_to_cart">
                                        <?php if($item->depot>0){?>
                                        <a onclick="addcart(this,'<?=$item->id?>')" title="افزودن به سبد">افزودن به سبد</a>
                                        <?php }else{ ?>
                                        <a title="ناموجود">ناموجود</a>
                                        <?php } ?>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <?php
                                            $favorite=Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first();

                                            if(empty($favorite)){?>
                                            <li class="wishlist"><a onclick="favorite(this,<?=$item->id?>)" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i>  افزودن به علاقه‌مندی‌ها</a></li>
                                        <?php }else{ ?>
                                            <li class="wishlist"><a style="color: red" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i>  افزودن به علاقه‌مندی‌ها</a></li>
                                            <?php } ?>
                                            <li class="quick_button">
                                                <a href="/product/<?=$item->slug?>"  title="مشاهده "> <span class="ion-ios-search-strong"></span> نمایش </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </article>
                </div>
                <?php
            }
        }else{?>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <h6 style="text-align: right;width: 100%">محصول مورد نظر یافت نشد!</h6>
            </div>

        <?php  }


        //$productTotal=array_filter($products);

    }

    public function about()
    {
        $options = Setting::all();
        $brands = Brand::where('status', 'Show')->get();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        $title="درباره ما";
        $seo_title="سئو درباره ما";
        $seo_content="سئو درباره ما";
        return view('front'.theme_name().'about.index', compact('title','seo_title','seo_content','setting','brands'));
    }
    public function contact_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'email' => 'required|email',
            'message' => 'required',

        ], [
            'name.required' => 'فیلد نام نمی تواند خالی باشد',
            'family.required' => 'فیلد نام خانوادگی نمی تواند خالی باشد',
            'email.required' => 'فیلد ایمیل نمی تواند خالی باشد',
            'email.email' => 'ایمیل نادرست است',
            'message.required' => 'فیلد متن نمی تواند خالی باشد',

        ]);
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->family=$request->family;
        $contact->message=$request->message;
        $contact->mobile=$request->mobile;
        $contact->email=$request->email;
        $contact->save();
        session()->put('save_comment','پیام شما با موفقیت ارسال شد!');
        return redirect()->back();
    }

    public function newslater_create(Request $request)
    {
        $club=new Club();
        $club->email=$request->email;
        $club->mobile=$request->mobile;
        $club->save();
        session()->put('save_newslater','ایمیل شما با موفقیت ثبت شد!');
        return redirect('/');
    }
}
