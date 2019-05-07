<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{
  use Sluggable;

//  protected $fillable = ['title', 'code', 'status', 'time', 'price', 'category_id', 'min_old', 'max_old', 'old_range', 'priority', 'words'];
  protected $guarded = [];





  public function articles()
  {
    return $this->belongsToMany(
        Article::class,
        'article_service',
        'service_id',
        'article_id'
    );
  }

  public function doctor() {
    return $this->belongsToMany(
        Doctor::class,
        'doctor_service',
        'service_id',
        'doctor_id'
    )->withPivot(['time', 'old_min', 'old_max', 'sort']);
  }

  public function priority() {
    return $this->belongsToMany(
        Doctor::class,
        'doctor_priority',
        'priority_id',
        'doctor_id'
    );
  }

  public static function add($fields)
  {
    $service = new static;
    $service->fill($fields);
    $service->save();
    return $service;
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function getDoctorTitle()
  {
    if (!$this->doctor->isEmpty()) {
      $template = '
      <a class="btn btn-info" data-toggle="collapse" href="#' . $this->slug . '" role="button" aria-expanded="false" aria-controls="' . $this->slug . '">
          Посмотреть всех докторов
      </a>
      <div class="collapse" id="' . $this->slug . '">
          <div class="card card-body">' .
              implode("<br>", $this->doctor->pluck("name")->all()) . '
          </div>
      </div>';
    } else {
      $template = 'Нет докторов';
    }
    echo $template;

  }
  public function isStatus() {
    if($this->status) {
      $this->status = "1";
    } else {
      $this->status = "0";
    }
    $this->save();

  }

  public function setPriority($ids)
  {
    if($ids == null){return;}
    $this->priority()->sync($ids);
  }

  public function getCategoryTitle()
  {
    return ($this->category != null)
        ?   $this->category->title
        :   'Категория отсудствует';
  }

  public function setOldRange($min, $max)
  {
    $result = [];

    for ($min;  $min <= $max; $min++) {
      array_push($result, $min);
    }

    $str_result = implode(', ', $result);

    $this->old_range = $str_result;

    $this->save();
  }

  public function getOldRange($min, $max)
  {
    $result = [];

    for ($min;  $min <= $max; $min++) {
      array_push($result, $min);
    }

    $str_result = implode(' лет, ', $result);

    $this->old_range = $str_result;

    echo $str_result;
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%')
        ->orWhere('code', 'like', '%'.$s.'%')
        ->orWhere('words', 'like', '%'.$s.'%');

  }

  public function checkStatus()
  {
    if ($this->status == 1) {
      echo '<i class="fas fa-check-circle"></i>';
    } else {
      echo '<i class="fas fa-times-circle"></i>';
    }
  }
  public function getStatus()
  {
    if ($this->status == 1) {
      return '<i class="fas fa-check-circle"></i>';
    } else {
      return '<i class="fas fa-times-circle"></i>';
    }
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
