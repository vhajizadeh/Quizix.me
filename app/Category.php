<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'parent_id', 'quick', 'limit_questions', 'position', 'paid', 'status'];

    public function question(){
        return $this->hasMany('App\Question');
    }

    public function children(){
	    return $this->hasMany('App\Category', 'parent_id', 'id');
	}

	public function parent(){
	    return $this->belongsTo('App\Category', 'parent_id');
	}
}