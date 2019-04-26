<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Phonebook extends Model
{
  use Sluggable;

  protected $guarded = [];

  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'title'
        ]
    ];
  }

  public static function add($fields)
  {
    $phone = new static;
    $phone->fill($fields);
    $phone->save();

    return $phone;
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%');
//        ->orWhere('category', 'like', '%'.$s.'%')
//        ->orWhere('info', 'like', '%'.$s.'%');
  }
  
}
