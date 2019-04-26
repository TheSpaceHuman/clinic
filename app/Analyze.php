<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Analyze extends Model
{
  use Sluggable;

//  protected $fillable = ['title', 'branch_1', 'branch_2', 'branch_3', 'branch_4', 'branch_5', 'branch_6', 'branch_7', 'price', 'material'];

  protected $guarded = ['id'];

  public function scopeSearch($query, $s)
  {
    return $query->where('title', 'like', '%'.$s.'%')
        ->orWhere('price', 'like', '%'.$s.'%');
  }

  public function switchShow()
  {
    if ($this->show === '1') {
      $this->show = '0';
      $this->save();
    } else {
      $this->show = '1';
      $this->save();
    }
  }

  public function article() {
    return $this->belongsTo(Article::class);
  }

  public function showArticle()
  {
    if ($this->article_id == null) { return; }
    echo '<a href="articles/show/' . $this->article['slug'] . '"><img src="image/icons/newspaper.svg" alt="Статья - ' . $this->article['title'] . '">';
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
