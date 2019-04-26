<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Spec;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DoctorController extends Controller
{
  public function index()
  {
    $doctors = Doctor::orderBy('name', 'asc')->paginate(16);
    $specs = Spec::all();

    return view('pages.doctor.index', [
        'doctors' => $doctors,
        'specs' => $specs
    ]);
  }

  public function searchService(Request $request)
  {
    $s = $request->input('s');
    $age = $request->input('age');

    $specs = Spec::all();


    $doctors = Doctor::query()
        ->whereHas('service', function (Builder $q)
        use ($s)
        {
          if ($s) {
            $q->where('name', 'like', '%' . $s . '%');
            $q->orWhere('words', 'like', '%' . $s . '%');
            $q->orderBy('sort', 'asc');
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
        ->paginate(16);


    return view('pages.doctor.search', compact(['specs', 'doctors', 's', 'age']));
  }

  public function showSpec($slug)
  {
    $specs = Spec::all();
    $spec = Spec::where('slug', $slug)
        ->firstOrFail();

    return view('pages.doctor.showSpec', compact(['specs', 'spec']));
  }

  public function showDoctor($slug)
  {
    $specs = Spec::all();
    $doctors = Doctor::all();
    $doctor = Doctor::where('slug', $slug)->firstOrFail();

    return view('pages.doctor.showDoctor', compact(['specs', 'doctors', 'doctor']));
  }

}
