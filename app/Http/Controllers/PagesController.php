<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use Route;
use App\User;

class PagesController extends Controller
{
    public function dashboard(){
        $questions = Question::orderBy('id', 'DESC')->limit(10)->get();
        $categories = Category::withCount('question')->orderBy('id', 'DESC')->limit(10)->get();
        $total_question = count(Question::all());
        $total_category = count(Category::all());

    	return view('admin.dashboard', compact('questions', 'categories', 'total_question', 'total_category'));
    }

    public function settings(){
    	return view('admin.settings');
    }

    public function profile(){
    	return view('admin.profile', compact('id'));
    }

    public function createUser(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect('admin/profile')->withType('success')->withMessage('User Added');
    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'upassword' => 'required|string|min:6|confirmed',
        ]);

        $id = \Auth::user()->id;
        $user = User::findorfail($id);

        $data = array();
        $data['password'] = bcrypt($request['password']);
        
        $user->update($data);        
        return redirect('admin/profile')->withType('success')->withMessage('Password Updated');
    }

    public function apiShowCategories(){
        $request = Route::getCurrentRequest();
        $request->headers->set('al', 'b');
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->orderBy('title', 'ASC')->where('status', 1)->get();
        return $categories;
    }

    public function apiShowSingleCategory($id){
        $category = Category::findorfail($id);
        return $category;
    }

    public function apiShowSingleCategoryQuestion($id){
        $questions = Category::findorfail($id)->question()->where('status', 1)->get();
        return $questions;
    }

    public function apiShowQuestions(){
        $questions = Question::orderBy('id', 'ASC')->where('status', 1)->get();
        return $questions;
    }

    public function apiShowSingleQuestion($id){
        $question = Question::findorfail($id)->get();
        return $question;
    }
}
