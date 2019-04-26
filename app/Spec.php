<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Spec extends Model
{
  use Sluggable;

  protected $fillable = ['title', 'description'];

  public function doctor() {
    return $this->belongsToMany(
        Doctor::class,
        'doctor_spec',
        'spec_id',
        'doctor_id'

    );

  }

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%');
  }

  /*public function getDoctor()
  {
    return (!$this->doctor == null)
        ?   $this->doctor : 'Нет доктора';
  }*/

  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'title'
        ]
    ];
  }
}
