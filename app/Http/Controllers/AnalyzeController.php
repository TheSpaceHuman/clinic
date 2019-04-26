<?php

namespace App\Http\Controllers;

use App\Analyze;
use Illuminate\Http\Request;

class AnalyzeController extends Controller
{
  public function index(Request $request)
  {

    $s = $request->input('s');
    //where('show', 1)
    $analyzes = Analyze::where('title','like' , '%'.$s.'%')
      ->orderBy('title', 'asc')
      ->paginate(50);

//    $analyze = Analyze::find(85);
//    dd($analyze->article->id);

    return view('pages.analyzes.index', compact(['analyzes', 's']));
  }


}
