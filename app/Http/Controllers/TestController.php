<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Category;
use App\Service;
use App\Spec;

class TestController extends Controller
{
  public function index()
  {
    $categories = Category::pluck('title', 'id')->all();
    $services = Service::pluck('title', 'id')->toJson();
    $branches = Branch::pluck('title', 'id')->all();
    $specs = Spec::pluck('title', 'id')->all();

    return view('admin.test', [
        'categories' => $categories,
        'services' => $services,
        'branches' => $branches,
        'specs' => $specs
    ]);
  }
}
