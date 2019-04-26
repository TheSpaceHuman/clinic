<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
  use Sluggable;

  protected $fillable = ['title', 'description'];


  public function articles()
  {
    return $this->belongsToMany(
        Article::class,
        'article_category',
        'category_id',
        'article_id'
    );
  }

  public function doctor() {
    return $this->belongsToMany(
        Doctor::class,
        'doctor_category',
        'category_id',
        'doctor_id'
    );
  }

  public function service() {
    return  $this->hasMany(Service::class);
  }

//  public function setDescription() {
//     if($this->description == null) {
//       $this->description = "Нет описания";
//     }
//     $this->save();
//  }

  public static function add($fields)
  {
    $category = new static;
    $category->fill($fields);
    $category->save();

    return $category;
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%');
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
