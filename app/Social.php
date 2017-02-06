<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'socials';
    protected $fillable = ['provider_id', 'provider', 'user_id'];
    public $timestamps = true;
}
