<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class News extends Model
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

  public function uploadImage($image)
  {
    if($image == null) { return; }

    $this->removeImage();
    $filename = str_random(10) . '.' . $image->extension();
    $image->storeAs('uploads/news', $filename);
    $this->image = $filename;
    $this->save();
  }

  public function getImage()
  {
    if($this->image == null)
    {
      return 'image/no-image.png';
    }

    return '/uploads/news/' . $this->image;

  }

  public function removeImage()
  {
    if($this->image != null)
    {
      Storage::delete('uploads/news/' . $this->image);
    }
  }

  public static function add($fields)
  {
    $news = new static;
    $news->fill($fields);
    $news->save();

    return $news;
  }

  public function getContent()
  {
//    $string = preg_replace("/&#?[a-z0-9]+;/i","", $string);
//    $remoweSpecialChars = e($this->content);
    $remoweTags = strip_tags($this->content);

//    $string =  Str::limit($text, 100);
    $string = str_limit($remoweTags, 150);

    return $string;
  }

  public function getData()
  {
    return $this->updated_at->format('d-m-Y');
  }


}
