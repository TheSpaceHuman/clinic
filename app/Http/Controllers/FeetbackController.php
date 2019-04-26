<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeetbackController extends Controller
{
  public function index()
  {
    return view('pages.feetback.index');
  }
}
