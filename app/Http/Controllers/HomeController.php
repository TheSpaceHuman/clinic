<?php

namespace App\Http\Controllers;


//use App\Doctor;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
   {
      $newsItems = News::orderBy('updated_at', 'desc')->get();

      return view('pages.index', compact('newsItems'));
   }

  public function show($id)
  {

    $news = News::find($id);

    return view('pages.news.show', compact('news'));
  }

  public function category($category)
  {

    $newsItems = News::query()
        ->where('category', $category)
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    return view('pages.news.category', compact(['newsItems']));

  }


}
