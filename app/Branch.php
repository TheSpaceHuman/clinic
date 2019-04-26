<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Branch extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'description'];

    public function doctor() {
      return $this->belongsToMany(
          Doctor::class,
          'doctor_branch',
          'branch_id',
          'doctor_id'

      );
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
