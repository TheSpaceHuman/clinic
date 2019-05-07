<?php

namespace App\Http\Controllers;

use App\Article;
use App\Branch;
use App\Category;
use App\Doctor;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{

  public function index()
  {
    $branches = Branch::pluck('title', 'id')->all();

    $categories = Category::all();

//    $services = Service::pluck('title', 'id')->all();
    $services = Service::all();



    $doctors = Doctor::orderBy('id', 'desc')->paginate(10);

    return view('pages.service.index', compact('categories', 'doctors', 'branches', 'services'));
  }

  public function searchService(Request $request)
  {
    $s = $request->input('s'); //service
    $age = $request->input('age');
    $branch = $request->input('branch');

    $categories = Category::all();

    $branches = Branch::pluck('title', 'id')->all();

    $services = Service::pluck('title', 'id')->all();

    $articles = Article::query()->whereHas('services', function (Builder $q)
      use ($s)
      {
        $q->where('service_id', $s);
      })->get();

    $doctors = Doctor::query()
        ->whereHas('branch', function (Builder $q)
        use ($branch)
        {
          if ($branch) {
            $q->where('doctor_branch.branch_id', $branch);
          }
        })
        ->whereHas('service', function (Builder $q)
        use ($s)
        {
          if ($s) {
            $q->where('service_id',  $s);
          }
        })
        ->whereHas('service', function (Builder $q)
        use ($age)
        {
          if ($age) {
            $q->where('old_min', '<=', $age);
            $q->where('old_max', '>=', $age);
          }
        })
        ->with(['service' => function ($q)
        use ($s)
        {
//          $service = Service::find($s);
          $q->orderBy('sort', 'desc');
        }])
        ->paginate(10);

    $currentService = Service::find($s)->get();



    return view('pages.service.search', compact('categories', 'doctors', 's', 'age', 'branch', 'branches', 'services', 'articles', 'currentService'));
  }

  public function showCategory($slug)
  {
    $categories = Category::all();
    $category = Category::where('slug', $slug)->firstOrFail();

    return view('pages.service.showCategory', compact('categories', 'category'));
  }

  public function showService($slug)
  {
    $categories = Category::all();
    $services = Service::all();
    $service = Service::where('slug', $slug)->firstOrFail();


    return view('pages.service.showService', compact('services', 'service', 'categories'));
  }

}
