<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chatroom extends Model
{
    protected $table = 'chatroom';
    protected $fillable = ['message'];
    public $timestamps = true;
    public function user(){
        return $this->belongsTo(User::class);
    }



}
