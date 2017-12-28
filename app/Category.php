<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'status'];

    public function question(){
        return $this->hasMany('App\Question');
    }
}