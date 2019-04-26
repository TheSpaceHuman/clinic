<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks = Task::paginate(10);
      return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $executors = User::where('is_secretary', 1)->get()
          ->filter(function ($value) {
            return $value->id !== Auth::user()->id;
          });

      return view('admin.tasks.create', compact(['executors']));
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
          'executor' => 'required'
      ]);

      $director = Auth::user();

      $task = Task::create([
          'title' => request('title'),
          'description' => request('description')
      ]);

      $task->setStatusDefault();
      $task->setDirector($director->id);
      $task->setExecutor($request->input('executor'));

      return redirect()->route('task.index');
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
      $task = Task::findOrFail($id);

      $executors = User::where('is_secretary', 1)->get()
          ->filter(function ($value) {
            return $value->id !== Auth::user()->id;
          });

      return view('admin.tasks.edit',  compact(['task', 'executors']));
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
          'executor' => 'required'
      ]);

      $director = Auth::user();

      $task = Task::findOrFail($id);

      $task->update([
          'title' => request('title'),
          'description' => request('description')
      ]);

      $task->setDirector($director->id);
      $task->setExecutor($request->input('executor'));
      $task->setRevision($request->revision);

      return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Task::findOrFail($id)->delete();
      return redirect()->route('task.index');
    }
}
