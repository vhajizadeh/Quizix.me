<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['category_id', 'title', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'answer', 'status'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
