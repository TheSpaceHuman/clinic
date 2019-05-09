<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Category;
use App\Doctor;
use App\Service;
use App\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $doctors = Doctor::orderBy('id', 'desc')
          ->search($s)
          ->paginate(10);

      return view('admin.doctors.index', ['doctors' => $doctors, 's' => $s]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::pluck('title', 'id')->all();
      $services = Service::orderBy('title', 'asc')->pluck('title', 'id')->all();
      $branches = Branch::pluck('title', 'id')->all();
      $specs = Spec::pluck('title', 'id')->all();

      return view('admin.doctors.create', [
          'categories' => $categories,
          'services' => $services,
          'branches' => $branches,
          'specs' => $specs
      ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name'	=>	'required|max:255' ,
            'category' => 'required',
            'spec' => 'required',
            'image' => 'image',
            'document' => 'file',
            'link' => 'max:255',
            'service[][service_id]' => 'integer',
            'service[][time]' => 'integer',
            'service[][old_min]' => 'integer',
            'service[][old_max]' => 'integer'
        ]);

        $doctor = Doctor::create([
            'name' => request('name'),
            'description' => request('description'),
            'link' => request('link')
        ]);

        $doctor->uploadImage($request->file('image'));
        $doctor->uploadDocument($request->file('document'));
        $doctor->setCategory($request->get('category'));
        $doctor->setService($request->get('service'));
        $doctor->setBranch($request->get('branch'));
        $doctor->setSpec($request->get('spec'));

        if ($request->has('is_exit')) {
          $doctor->is_exit = '1';
        } else {
          $doctor->is_exit = '0';
        }
          $doctor->save();


        return redirect()->route('doctors.index');
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

      $doctor = Doctor::findOrFail($id);
      $categories = Category::pluck('title', 'id')->all();
      $services = Service::orderBy('title', 'asc')->pluck('title', 'id')->all();
      $branches = Branch::pluck('title', 'id')->all();
      $specs = Spec::pluck('title', 'id')->all();
      $selectedCategory = $doctor->category->pluck('id')->all();
      $selectedService = $doctor->service->pluck('id')->all();
      $selectedBranch = $doctor->branch->pluck('id')->all();
      $selectedSpec = $doctor->spec->pluck('id')->all();

      return view('admin.doctors.edit', [
          'categories' => $categories,
          'services' => $services,
          'branches' => $branches,
          'specs' => $specs,
          'doctor' => $doctor,
          'selectedCategory' => $selectedCategory,
          'selectedService' => $selectedService,
          'selectedBranch' => $selectedBranch,
          'selectedSpec' => $selectedSpec,
      ]);
    }

    public function clone($id)
    {

      $doctor = Doctor::findOrFail($id);
      $categories = Category::pluck('title', 'id')->all();
      $services = Service::pluck('title', 'id')->all();
      $branches = Branch::pluck('title', 'id')->all();
      $specs = Spec::pluck('title', 'id')->all();
      $selectedCategory = $doctor->category->pluck('id')->all();
      $selectedService = $doctor->service->pluck('id')->all();
      $selectedBranch = $doctor->branch->pluck('id')->all();
      $selectedSpec = $doctor->spec->pluck('id')->all();

      return view('admin.doctors.clone', [
          'categories' => $categories,
          'services' => $services,
          'branches' => $branches,
          'specs' => $specs,
          'doctor' => $doctor,
          'selectedCategory' => $selectedCategory,
          'selectedService' => $selectedService,
          'selectedBranch' => $selectedBranch,
          'selectedSpec' => $selectedSpec,
      ]);
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
          'name'	=>	'required|max:255' ,
          'category' => 'required',
          'branch' => 'required',
          'spec' => 'required',
          'image' => 'image',
          'document' => 'file',
          'link' => 'max:255',
          'service[][service_id]' => 'integer',
          'service[][time]' => 'integer',
          'service[][old_min]' => 'integer',
          'service[][old_max]' => 'integer'
      ]);

      $doctor = Doctor::findOrFail($id);

      $doctor->update([
          'name' => request('name'),
          'description' => request('description'),
          'link' => request('link')
      ]);


        $doctor->uploadImage($request->file('image'));
        $doctor->uploadDocument($request->file('document'));
        $doctor->setCategory($request->get('category'));
        $doctor->setService($request->get('service'));
        $doctor->setBranch($request->get('branch'));
        $doctor->setSpec($request->get('spec'));


        if ($request->has('is_exit')) {
          $doctor->is_exit = '1';
        } else {
          $doctor->is_exit = '0';
        }
        $doctor->save();


      return redirect()->route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $doctor = Doctor::findOrFail($id);

      $doctor->removeImage();
      $doctor->removeDocument();
      $doctor->delete();

      return redirect()->route('doctors.index');
    }
}
