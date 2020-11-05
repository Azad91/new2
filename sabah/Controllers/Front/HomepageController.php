<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

class HomepageController extends Controller
{
    public function __construct(){
      view()->share('pages', Page::where('status',1)->orderBy('order', 'ASC')->get());
      // view()->share('categories', Category::where('status',1)->inRandomOrder()->get());
      // view()->share('categories', Category::where('status',1)->get());
      view()->share('categories', Category::where('status',1)->orderBy('created_at', 'ASC')->get());
      view()->share('articles', Article::where('status',1)->orderBy('created_at', 'ASC')->get());
    }

    public function index()
    {
      $data['articles']=Article::where('status',1)->orderBy('created_at', 'DESC')->get();
      // $data['articles']=Article::orderBy('created_at', 'DESC')->paginate(2);
      return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
      $category=Category::whereSlug($category)->first() ?? abort(403, 'Boyle bi kategori bulunamadi!!');

      $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Boyle bi yazi bulunamadi!!');
      $article->increment('hit');

      $data['article']=$article;
      return view('front.single', $data);
    }

    public function category($slug)
    {
      $category=Category::whereSlug($slug)->first() ?? abort(403, 'Boyle bi kategori bulunamadi!!');
      $data['category']=$category;
      $data['articles']=Article::where('status',1)->where('category_id',$category->id)->orderBy('created_at', 'DESC')->get();
      return view('front.category', $data);
    }

    public function page($slug){
      $page=Page::whereSlug($slug)->first() ?? abort(403, 'Boyle bir sayfa bulunamadi!!');
      $data['page']=$page;
      return view('front.page', $data);
    }

    public function contact()
    {
      return view('front.contact');
    }

    public function contactpost(Request $request){

      $rules=[
        'name'=>'required|min:5',
        'email'=>'required|email',
        'topic'=>'required',
        'message'=>'required|min:10'
      ];
      $validate=Validator::make($request->post(),$rules);

      if($validate->fails()){
        return redirect()->route('contact')->withErrors($validate)->withInput();
      }
      $contact = new Contact;
      $contact->name=$request->name;
      $contact->email=$request->email;
      $contact->topic=$request->topic;
      $contact->message=$request->message;
      $contact->save();
      return redirect()->route('contact')->with('success', 'Mesaj gonderildi!!');
    }
}
