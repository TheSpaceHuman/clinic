<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Files extends Model
{

  protected $fillable = ['title','link'];

  public static function dowload($file, $name)
  {
    if($file == null) { return; }

    $files = new static;
    $files->title = $name;

    $filename = $name . '_' . str_random(5) . '.' . $file->extension();
    $file->storeAs('uploads/files', $filename);
    $files->link = 'uploads/files/' . $filename;

    $file_url = 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/files/' . $filename; //ссылка на файл
    $url_encode = urlencode($file_url);
    $office_url = 'https://view.officeapps.live.com/op/view.aspx?src=' . $url_encode;

    $files->office_link = $office_url;
    $files->save();
  }

  public function removeFile()
  {
    if($this->link != null)
    {
      Storage::delete($this->link);
    }
  }

  public function updateFile($file, $name)
  {
    $this->removeFile();
    $this->title = $name;
    $filename = $name . '_' . str_random(5) . '.' . $file->extension();
    $file->storeAs('uploads/files', $filename);
    $this->link = 'uploads/files/' . $filename;

    $file_url = 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/files/' . $filename; //ссылка на файл
    $url_encode = urlencode($file_url);
    $office_url = 'https://view.officeapps.live.com/op/view.aspx?src=' . $url_encode;

    $this->office_link = $office_url;

    $this->save();
  }
}
