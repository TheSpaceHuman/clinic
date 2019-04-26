<?php

namespace App\Http\Controllers\Admin;

use App\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $specs = Spec::orderBy('title', 'asc')
          ->search($s)
          ->paginate(10);

      return view('admin.specs.index', compact(['specs', 's']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.specs.create');
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
          'title'	=>	'required'
      ]);

      Spec::create([
          'title' => request('title'),
          'description' => request('description')
      ]);

      return redirect()->route('spec.index');

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
      $spec = Spec::findOrFail($id);
      return view('admin.specs.edit',  ['spec'=> $spec]);
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
          'title'	=>	'required'
      ]);


      $spec = Spec::findOrFail($id);

      $spec->update([
          'title' => request('title'),
          'description' => request('description')
      ]);

      return redirect()->route('spec.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Spec::findOrFail($id)->delete();
      return redirect()->route('spec.index');
    }
}
