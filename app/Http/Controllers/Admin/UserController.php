<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $s = $request->input('s');
    $users = User::latest()
        ->search($s)
        ->paginate(20);

    return view('admin.users.index', compact(['users', 's']));
  }

  public function create()
  {
    return view('admin.users.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'name'	=>	'required|max:255' ,
        'email' => 'required|email|unique:users',
    ]);

    $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt('password')
    ]);
    $user->setPassword($request->input('password'));
    $user->setAdmin($request);
    $user->setSecretary($request);

    return redirect()->route('users.index');
  }

  public function edit($id)
  {
    $currentUser = Auth::user();

    $user = User::findOrFail($id);

    /*   if ($currentUser->id == $id || $currentUser->id == 1)
       {
         $user = User::findOrFail($id);
         return view('admin.users.edit', compact('user'));
       }

       return back()->with('user.update.protected', 'Вы не можете редактировать чужого пользователя!');*/

    if ($id == 1 && $currentUser->id !== 1)
    {
      return back()->with('user.update.protected', 'Вы не можете редактировать данного пользователя!');
    }

    return view('admin.users.edit', compact('user'));

  }

  public function update(Request $request, $id)
  {

    $this->validate($request, [
        'name'	=>	'required|max:255' ,
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($id),
        ]
    ]);
    $user = User::findOrFail($id);
    $user->update([
        'name' => request('name'),
        'email' => request('email')
    ]);
    $user->setPassword($request->input('password'));
    $user->setAdmin($request);
    $user->setSecretary($request);

    return redirect()->route('users.index');
  }

  public function destroy($id)
  {
    if ($id == 1) {
      return redirect()->route('users.index')->with('admin.protected', 'Создалетя удалить не получиться =)');
    }

    User::findOrFail($id)->delete();

    return redirect()->route('users.index');
  }

  public function show($id)
  {
    abort(404);
  }

}
