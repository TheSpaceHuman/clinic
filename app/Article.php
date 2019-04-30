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
//    $strS = '<p>' . $this->services->pluck('title')->all() . '</p>';
    $strF = '<p>' . 'Услуга не назначена' . '</p>';

//    echo (!$this->services->isEmpty())
//        ?   implode('<br>', $strS)
//        : $strF;
    if (!$this->services->isEmpty()) {
      foreach($this->services->pluck('title')->all() as $elem)
      {
        echo  '<p>'. $elem . '</p>';
      }
    } else {
      echo  $strF;
    }

  }

  public function analyze() {
    return  $this->hasMany(Analyze::class);
  }

}
