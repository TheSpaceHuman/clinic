<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index(Request $request)
  {
    $s = $request->input('s');
    $article_categories = ArticleCategory::orderBy('title', 'asc')->get();
    $articles = Article::query()
        ->where('title','like' , '%'.$s.'%')
        ->orWhere('content','like' , '%'.$s.'%')
        ->paginate(10);


    return view('pages.article.index', compact('articles', 's','article_categories'));
  }

  public function show($slug)
  {
    $article = Article::where('slug', $slug)->firstOrFail();

    return view('pages.article.show', compact('article'));

  }

  public function showCategory($slug)
  {
    $article_categories = ArticleCategory::orderBy('title', 'asc')->get();
    $article_category = ArticleCategory::where('slug', $slug)->firstOrFail();
    $articles = Article::where('article_category_id', $article_category->id)->paginate(10);

    return view('pages.article.showCategory', compact('articles', 'article_category', 'article_categories'));
  }


}
