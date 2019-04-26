<?php

namespace App\Http\Controllers;

use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
  public function index()
  {
    $categories = Phonebook::all()->unique('category')->pluck('category');

    $phones = Phonebook::all();

    return view('pages.phonebook.index', [
        'phones' => $phones,
        'categories' => $categories
    ]);
  }
}
