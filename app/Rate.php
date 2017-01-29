<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Todo;
class Rate extends Model
{
    protected $table = 'todo';
    protected $fillable = ['user_id','todo_id','rating'];
    public $timestamps = true;

    public function todo(){
        return $this->belongsTo('App\Todo');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
