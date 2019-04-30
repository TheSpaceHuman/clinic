<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Doctor;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $services = Service::latest()
          ->search($s)
          ->paginate(20);

      return view('admin.services.index', ['services' => $services, 's' => $s]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      $categoriesToSelect = Category::pluck('title', 'id')->all();
      $dostors = Doctor::pluck('name', 'id')->all();
      return view('admin.services.create', [
          'doctors' => $dostors,
          'categories' => $categories,
          'categoriesToSelect' => $categoriesToSelect
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
      $this->validate($request, [
          'title'	=>	'required|max:255' ,
          'code' => 'required|max:11',
//          'time' => 'required|max:11',
          'price' => 'required|max:11',
//          'min_old' => 'required|max:3',
//          'max_old' => 'required|max:3'
      ]);

        $service = Service::add($request->all());

        $service->setPriority($request->input('category_id'));

        $service->setOldRange(request('min_old'), request('max_old'));

        if ($request->has('status')) {
          $service->status = 1;
        } else {
          $service->status = 0;
        }
        $service->save();


        return redirect()->route('service.index');

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
    public function clone($id)
    {
      $service = Service::findOrFail($id);
      $dostors = Doctor::pluck('name', 'id')->all();
      $selectedDoctor = !$service->doctor->isEmpty() ? $service->doctor->pluck('id')->all() : null;
      $categories = Category::pluck('title', 'id')->all();
      $selectedCategory = null;
      if ($service->category) {
        $selectedCategory = $service->category->where('id', $service->category_id)->pluck('title', 'id');
      }



      return view('admin.services.clone', [
          'service'=> $service,
          'doctors' => $dostors,
          'selectedDoctor' => $selectedDoctor,
          'selectedCategory' => $selectedCategory,
          'categories' => $categories
      ]);
    }


    public function edit($id)
    {

      $service = Service::findOrFail($id);
      $dostors = Doctor::pluck('name', 'id')->all();
      $selectedDoctor = $service->doctor->pluck('id')->all();
      $categories = Category::pluck('title', 'id')->all();





      return view('admin.services.edit', [
          'service'=> $service,
          'doctors' => $dostors,
          'selectedDoctor' => $selectedDoctor,
          'categories' => $categories
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
          'title'	=>	'required|max:255',
          'code' => 'required|max:11',
//          'time' => 'required|max:11',
          'price' => 'required|max:11',
//          'min_old' => 'required|max:3',
//          'max_old' => 'required|max:3'
      ]);

      $service = Service::findOrFail($id);

//      dd($request->all());
      $service->update($request->all());

      $service->setOldRange(request('min_old'), request('max_old'));

      if ($request->has('status')) {
        $service->status = '1';
      } else {
        $service->status = '0';
      }
      $service->save();

      return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Service::findOrFail($id)->delete();
      return redirect()->route('service.index');
    }
}
