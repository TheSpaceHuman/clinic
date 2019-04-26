<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

  public function profile()
  {
    $user = Auth::user();

    return view('pages.profile.update', compact('user'));
  }


  public function update(Request $request, $id)
  {

    $user = User::findOrFail($id);

    $this->validate($request, [
        'name'	=>	'required|max:255' ,
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($id),
        ]
    ]);

    $user->update([
        'name' => request('name'),
        'email' => request('email')
    ]);

    $user->setPassword($request->input('password'));

    return redirect()->route('index');

  }
}
