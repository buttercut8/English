<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
     'name', 'email','skype','facebook','twitter','password','avatar', 'ip_address','phone','about_me','background'
    ];
    public $timestamps = true;
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
         'password', 'remember_token','ip_address'
     ];
     public function todo(){
         return $this->hasMany(Todo::class);
     }
     public function rate(){
         return $this->hasMany(Rate::class);
     }
     public function chatroom(){
         return $this->hasMany(Chatroom::class);
     }

}
