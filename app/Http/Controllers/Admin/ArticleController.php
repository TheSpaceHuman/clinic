<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleCategory;
use App\Category;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $articles = Article::latest()
          ->search($s)
          ->paginate(10);


      return view('admin.articles.index', compact(['articles', 's']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $services = Service::all()->pluck('title', 'id');
      $article_categories = ArticleCategory::orderBy('title', 'acs')->pluck('title', 'id');

      return view('admin.articles.create', compact('services','article_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validated = $this->validate($request, [
          'title'	=>	'required|max:255',
          'content' => 'required',
          'introtext' => 'required|max:1000',
          'article_category_id' => 'required'
      ]);

      $article = Article::create($validated);

      $article->setAuthor($request->get('author'));

      return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $article = Article::findOrFail($id);
      $services = Service::all()->pluck('title', 'id');
      $selectServices = $article->services()->pluck('service_id')->all();
      $article_categories = ArticleCategory::orderBy('title', 'acs')->get();
      $select_article_category = $article->articleCategory()->pluck('title', 'id');

      return view('admin.articles.edit',  compact(['article', 'services', 'selectServices', 'article_categories', 'select_article_category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validated = $this->validate($request, [
          'title'	=>	'required|max:255',
          'content' => 'required',
          'introtext' => 'required|max:1000',
          'article_category_id' => 'required'
      ]);

      $article = Article::findOrFail($id);

      $article->update($validated);

      $article->setAuthor($request->get('author'));

      return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Article::findOrFail($id)->delete();
      return redirect()->route('article.index');
    }
}
