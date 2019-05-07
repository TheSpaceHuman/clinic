<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
  use Sluggable;

  protected $guarded = ['id'];

  public function category() {
    return $this->belongsToMany(
        Category::class,
        'doctor_category',
        'doctor_id',
        'category_id'
    );
  }

  public function spec() {
    return $this->belongsToMany(
        Spec::class,
        'doctor_spec',
        'doctor_id',
        'spec_id'
    );
  }

  public function branch() {
    return $this->belongsToMany(
        Branch::class,
        'doctor_branch',
        'doctor_id',
        'branch_id'
    );
  }


  public function service() {
    return $this->belongsToMany(
        Service::class,
        'doctor_service',
        'doctor_id',
        'service_id'
    )->withPivot(['time', 'old_min', 'old_max', 'sort']);
  }

  public function getCategoryId()
  {
    return $this->category != null ? $this->category->id : null;
  }
  public function getServiceId()
  {
    return $this->service != null ? $this->service->id : null;
  }
  public function getCategoryTitle()
  {
    return (!$this->category->isEmpty())
        ?   implode(', ', $this->category->pluck('title')->all())
        : 'Нет категорий';

  }

  public function isExis() {
    if($this->is_exit) {
      $this->is_exit = "1";
    } else {
      $this->is_exit = "0";
    }
    $this->save();
  }

  public function getExit()
  {
    if ($this->is_exit == '1') {
    //      echo '<i class="fas fa-truck" title="Выездной"></i>';
    echo '<span style="color: #00b9aa;">Да</span>';
    } else {
      //      echo '<i class="far fa-times-circle"  title="Не выездной"></i>';
      echo '<span style="color: #ff6974;">Нет</span>';
    }


  }

  public function getDescription()
  {
     echo (!$this->description == null)
         ?   $this->description : 'Примечание отсутствует';
  }

  public function getServiceTitle()
  {
    if (!$this->service->isEmpty()) {
      $template = '
      <a class="btn btn-info" data-toggle="collapse" href="#' . $this->slug . '" role="button" aria-expanded="false" aria-controls="' . $this->slug . '">
          Посмотреть всех докторов
      </a>
      <div class="collapse" id="' . $this->slug . '">
          <div class="card card-body">' .
          implode("<br>", $this->service->pluck("title")->all()) . '
          </div>
      </div>';
    } else {
      $template = 'Нет сервисов';
    }
    echo $template;
  }

  public function getServiceCode()
  {
    echo (!$this->service->isEmpty())
        ?   implode('<br>', $this->service->pluck('code')->all())
        : 'Нет кода';
  }

  public function getServiceTitleTimeCode()
  {
    if (!$this->service->isEmpty()) {
      foreach ($this->service as $service) {
        echo '<tr><td>' . $service->title . '</td><td>' . $service->pivot->time . '</td><td>'. $service->pivot->old_min.'-'.$service->pivot->old_max . '</td><td>' . $service->code . '</td><td>'. $service->getStatus() .'</td></tr>';
      }
    }
  }

  public function getServiceTime()
  {
    echo (!$this->service->isEmpty())
        ?   implode('<br>', $this->service->pluck('time')->all())
        : 'Нет времени';
  }

  public function getBranchTitle()
  {
    echo (!$this->branch->isEmpty())
        ?   implode('<br>', $this->branch->pluck('title')->all())
        : 'Нет филиалов';
  }
  public function getSpecTitle()
  {
    echo (!$this->spec->isEmpty())
        ?   implode('<br>', $this->spec->pluck('title')->all())
        : 'Нет специализаций';
  }

  public function getServiceOldRange()
  {
    foreach ($this->service as $service) {
      echo $service->old_range . '<br>';
    }

  }

  public function priority() {
    return $this->belongsToMany(
        Service::class,
        'doctor_priority',
        'doctor_id',
        'priority_id'
    );
  }

  public function setCategory($ids)
  {
    if($ids == null){return;}
    $this->category()->sync($ids);
  }

  public function setService($ids)
  {
    if($ids == null){return;}
    $this->service()->sync($ids);
  }

  public function setBranch($ids)
  {
    if($ids == null){return;}
    $this->branch()->sync($ids);
  }

  public function setSpec($ids)
  {
    if($ids == null){return;}
    $this->spec()->sync($ids);
  }

  public function checkSort()
  {
    if($this->pivot->sort == 1) {
      return true;
    } else {
      return false;
    }
  }

  public function removeImage()
  {
    if($this->image != null)
    {
      Storage::delete('uploads/avatar/' . $this->image);
    }
  }
  public function removeDocument()
  {
    if($this->document != null)
    {
      Storage::delete('uploads/documents/' . $this->document);
    }
  }

  public function uploadDocument($file)
  {
    if($file == null) { return; }

    $this->removeDocument();
    $filename = str_random(10) . '.' . $file->extension();
    $file->storeAs('uploads/documents', $filename);
    $this->document = $filename;
    $this->save();
  }
  public function getDocument()
  {
    if($this->document == null)
    {
      return '';
    }

    return '/uploads/documents/' . $this->document;

  }


  public function uploadImage($image)
  {
    if($image == null) { return; }

    $this->removeImage();
    $filename = str_random(10) . '.' . $image->extension();
    $image->storeAs('uploads/avatar', $filename);
    $this->image = $filename;
    $this->save();
  }

  public function getImage()
  {
    if($this->image == null)
    {
      return 'image/no-avatar.jpg';
    }

    return '/uploads/avatar/' . $this->image;

  }
  public static function add($fields)
  {
    $doctor = new static;
    $doctor->fill($fields);
    $doctor->save();

    return $doctor;
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('name', 'like', '%'.$s.'%');

  }
  public function searchService($age)
  {
    return $this->belongsToMany('App\Service')
        ->wherePivot('old_min', '>=', $age)
        ->wherePivot('old_max', '<=', $age);

  }

  public function getServiceSort($serviceId)
  {

    $sort = DB::table('doctor_service')
        ->where('doctor_id', $this->id)
        ->where('service_id', $serviceId)
        ->get()->toArray();

    return $sort[0]->sort;

  }

  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
  }

}
