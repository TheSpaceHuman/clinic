<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function index()
  {
    $director = Auth::user();

    $tasks = Task::where('executor_id', $director->id)->get()->filter(function ($task){
      return $task->status !== '2';
    });

    return view('pages.tasks.index', compact('tasks'));
  }

  public function update(Request $request, $id)
  {

    $task = Task::find($id);

    $task->update([
        'message' => $request->message,
        'status' => $request->status
    ]);

    if ($request->status == '2') {
      $task->setTimeFinishTask();
    }


    return redirect()->route('page.task.index');
  }

  public function newTask(Request $request)
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

    return redirect()->route('index');
  }
  
  
}
