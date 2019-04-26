<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ArtCategories = ArticleCategory::orderBy('title', 'asc')->get();

        return view('admin.ArticleCategories.index', compact('ArtCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.ArticleCategories.create');
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
          'description' => 'max:255',
      ]);

      ArticleCategory::create($validated);

      return redirect()->route('art-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $articleCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $articleCategory = ArticleCategory::find($id);

      return view('admin.ArticleCategories.edit', compact('articleCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'title'	=>	'required|max:255',
          'description' => 'max:255',
      ]);

      $articleCategory = ArticleCategory::find($id);

      $articleCategory->update([
          'title' => $request->input('title'),
          'description' => $request->input('description')
      ]);
/*      $article->update([
          'title' => request('title'),
          'content' => request('content'),
          'introtext' => request('introtext')
      ]);*/

      return redirect()->route('art-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $articleCategory = ArticleCategory::find($id);

      $articleCategory->delete();

      return back();
    }
}
