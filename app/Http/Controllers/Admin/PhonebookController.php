<?php

namespace App\Http\Controllers\Admin;

use App\Phonebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $s = $request->input('s');
      $categories = Phonebook::all()->pluck('category', 'id');
      $phones = Phonebook::query()
          ->where('title', 'like', '%'.$s.'%')
          ->orWhere('category', 'like', '%'.$s.'%')
          ->orWhere('info', 'like', '%'.$s.'%')
          ->orderBy('id', 'desc')
          ->paginate(20);




      return view('admin.phonebook.index', ['phones' => $phones, 'categories' => $categories, 's' => $s]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = ['Экстренные телефоны', 'Сотрудники клиники 1', 'Сотрудники клиники 2', 'Внутренние номер всех клиник', 'Партнеры клиники'];

      return view('admin.phonebook.create' , compact('categories'));

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
          'category'	=>	'required|max:255'
      ]);

      Phonebook::add($request->all());

      return redirect()->route('phonebook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $categories = ['Экстренные телефоны', 'Сотрудники клиники 1', 'Сотрудники клиники 2', 'Внутренние номер всех клиник', 'Партнеры клиники'];

      $phone = Phonebook::findOrFail($id);
      return view('admin.phonebook.edit', ['phone'=>$phone , 'categories' => $categories]);
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
          'category'	=>	'required|max:255'
      ]);

      $phones = Phonebook::findOrFail($id);

      $phones->update($request->all());

      return redirect()->route('phonebook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Phonebook::findOrFail($id)->delete();
      return redirect()->route('phonebook.index');
    }
}
