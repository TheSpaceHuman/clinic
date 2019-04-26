<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ArticleCategory extends Model
{
  use Sluggable;
  protected $guarded = ['id'];

  public function article() {
    return  $this->hasMany(Article::class);
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
