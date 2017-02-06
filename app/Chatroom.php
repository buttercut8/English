<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    protected $table = 'chatroom';
    protected $fillable = ['message'];
    // protected $fillable = ['message','user_id'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }



}
