<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Branch;
use App\Category;
use App\Service;
use App\Spec;
use App\Article;
use App\Doctor;

class TestController extends Controller
{
  public function addServices()
  {
    $categories = Category::pluck('title', 'id')->all();
    $services = Service::pluck('title', 'id')->toJson();
    $branches = Branch::pluck('title', 'id')->all();
    $specs = Spec::pluck('title', 'id')->all();

    return view('admin.testing.addServices', [
        'categories' => $categories,
        'services' => $services,
        'branches' => $branches,
        'specs' => $specs
    ]);
  }

  public function servicesSearch(Request $request)
  {
    $s = $request->input('s');
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
        ->paginate(10);

    return view('pages.testing.servicesSearch', compact('categories', 'doctors', 's', 'age', 'branch', 'branches', 'services', 'articles'));
  }
}
