<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Rate;
class Todo extends Model
{
    protected $table = 'todo';
    protected $fillable = ['title','content','images','user_id','complete','progress','favorite'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rate(){
        return $this->hasMany(Rate::class);
    }

}
