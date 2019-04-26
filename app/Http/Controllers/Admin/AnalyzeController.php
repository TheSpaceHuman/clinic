<?php

namespace App\Http\Controllers\Admin;

use App\Analyze;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyzeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $analyzes = Analyze::orderBy('title', 'asc')
          ->search($s)
          ->paginate(50);

      return view('admin.analyzes.index', compact(['analyzes', 's']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $articles = Article::orderBy('title', 'asc')->get();

      return view('admin.analyzes.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'title'	=>	'required|max:255',
          'price' => 'required|integer',
          'material' => 'required|string'
      ]);

      Analyze::create($request->all());

      return redirect()->route('analyze.index');
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


    public function switchShow($id)
    {
      $analyze = Analyze::findOrFail($id);
      $analyze->switchShow();
      return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $analyze = Analyze::findOrFail($id);
      $articles = Article::orderBy('title', 'asc')->get();

      return view('admin.analyzes.edit', compact('analyze', 'articles'));
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
      $this->validate($request, [
          'title'	=>	'required|max:255',
          'price' => 'required|integer',
          'material' => 'required|string'
      ]);

      $analyze = Analyze::findOrFail($id);

      $analyze->update($request->all());

      return redirect()->route('analyze.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Analyze::findOrFail($id)->delete();
      return redirect()->route('analyze.index');
    }
}
