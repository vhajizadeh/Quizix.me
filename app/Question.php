<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['category_id', 'title', 'question_type', 'thumbnail', 'number_of_answer', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'choice_e', 'photo', 'answer', 'explanation', 'status'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
