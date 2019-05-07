<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
  use Sluggable;

  protected $guarded = ['id'];

  public function getIntrotext($text)
  {
    $string = str_limit($text, 550);

    return $string;
  }

  public function getContent()
  {
    echo $this->content;
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%')
        ->orWhere('author', 'like', '%'.$s.'%');
  }

  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'title'
        ]
    ];
  }

  public function articleCategory() {
    return $this->belongsTo(ArticleCategory::class);
  }

  public function categories()
  {
    return $this->belongsToMany(
        Category::class,
        'article_category',
        'article_id',
        'category_id'
    );
  }

  public function services()
  {
    return $this->belongsToMany(
        Service::class,
        'article_service',
        'article_id',
        'service_id'
    );
  }

  public function setAuthor($ids)
  {
    if($ids == null){return;}
    $this->services()->sync($ids);
  }

  public function getCategories()
  {
    echo (!$this->categories->isEmpty())
        ?   implode(' ,', $this->categories->pluck('title')->all())
        : 'Нет автора';
  }
  public function getServices()
  {
//    $strF = '<p>' . 'Услуга не назначена' . '</p>';
//
//    if (!$this->services->isEmpty()) {
//      foreach($this->services->pluck('title')->all() as $service)
//      {
//        echo  '<p>'. $elem . '</p>';
//      }
//    } else {
//      echo  $strF;
//    }

    if (!$this->services->isEmpty()) {
      $template = '
      <a class="btn btn-outline-primary btn-sm mb-2 ml-2 " data-toggle="collapse" href="#' . $this->slug . '" role="button" aria-expanded="false" aria-controls="' . $this->slug . '">
          Посмотреть все услуги
      </a>
      <div class="collapse" id="' . $this->slug . '">
          <div class="card card-body">' .
          implode("<br>", $this->services->pluck("title")->all()) . '
          </div>
      </div>';
    } else {
      $template = 'Нет услуг';
    }
    echo $template;

  }

  public function analyze() {
    return  $this->hasMany(Analyze::class);
  }

}
