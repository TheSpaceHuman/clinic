<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Task extends Model
{
  use Sluggable;

  protected $guarded = ['id'];

  public function setStatusDefault()
  {
    $this->status = '0'; // 0 - не принято 1 - выполняеться 2 - выполнено
    $this->save();
  }

  public function setRevision($revision)
  {
    if ($revision) {
      $this->status = '0';
      $this->save();
    }
  }

  public function getStatus()
  {
    if ($this->status == '0') {
      echo '<p class="text-warning" style="font-weight: 700;">Поставлена</p>';
    } elseif ($this->status == '1') {
      echo '<p class="text-primary" style="font-weight: 700;">В работе</p>';
    } elseif ($this->status == '2') {
      echo '<p class="text-success" style="font-weight: 700;">Выполнена</p>';
    }
  }

  public function Status0()
  {
    return $this->status == '0' ? true : false;
  }

  public function Status1()
  {
    return $this->status == '1' ? true : false;
  }

  public function Status2()
  {
    return $this->status == '2' ? true : false;
  }

  public function setMessage()
  {
    $this->message !== null ? $this->message : null;
    $this->save();
  }

  public function getMessage()
  {
    return $this->message !== null ? $this->message : '';
  }

  public function getTimeCreate()
  {

    $time =  $this->created_at;

    $data = $time->setTimezone('Europe/Moscow')->format('H:i d/m/y');

    return $data;

  }

  public function setTimeFinishTask()
  {
    $now = Carbon::now();

    $this->time_finish_task = $now;

    $this->save();
  }

  public function getTimeFinishTask()
  {
    if ($this->time_finish_task == null) { return; }
    $data =  $this->time_finish_task;
    $time = new Carbon($data);
    $time->setTimezone('Europe/Moscow')->format('H:i d/m/y');
    return $time;
  }

  public function setDirector($director_id)
  {
    $this->director_id = $director_id;
    $this->save();
  }

  public function setExecutor($executor_id)
  {
    $this->executor_id = $executor_id;
    $this->save();
  }




  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'title'
        ]
    ];
  }
}
