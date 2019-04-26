<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'password', 'remember_token',
    ];

  public function setAdmin($request)
  {
    if($request->has('is_admin')) {
      $this->is_admin = 1;
    } else {
      $this->is_admin = 0;
    }
    $this->save();
  }
  public function setSecretary($request)
  {
    if($request->has('is_secretary')) {
      $this->is_secretary = 1;
    } else {
      $this->is_secretary = 0;
    }
    $this->save();
  }

  public function setPassword($password)
  {
    if ($password != null ) {
      $this->password = bcrypt($password);
      $this->save();
    }
  }

  public function scopeSearch($query, $s)
  {
    return $query->where('name', 'like', '%'.$s.'%')
        ->orWhere('email', 'like', '%'.$s.'%');
  }

}
