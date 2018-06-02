<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'DESC')->paginate(10);
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->orderBy('title', 'ASC')->get();
        return view('admin.question.index', compact('questions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        return view('admin.question.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->email != 'arifkpi@gmail.com'){
            return 'Add/Edit/Delete disabled on Demo!';
        }

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'question_type' => 'required',
            'thumbnail' => 'required_if:question_type,photo|mimes:jpeg,jpg,png,bmp,gif',
            'number_of_answer'  => 'required',
            'choice_a' => 'required',
            'choice_b' => 'required',
            'choice_c' => 'required_if:number_of_answer,3|required_if:number_of_answer,4',
            'choice_d' => 'required_if:number_of_answer,4',            
            'answer' => 'required',
        ]);             

        $data = $request->all();
         
        $choice_a = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_a'], 1));
        $data['choice_a'] = preg_replace('/(<br>)+$/', '', $choice_a);
        
        $choice_b = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_b'], 1));
        $data['choice_b'] = preg_replace('/(<br>)+$/', '', $choice_b);
        
        if($data['choice_c'] != null){
            $choice_c = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_c'], 1));
            $data['choice_c'] = preg_replace('/(<br>)+$/', '', $choice_c);
        }
        
        if($data['choice_d'] != null){
            $choice_d = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_d'], 1));
            $data['choice_d'] = preg_replace('/(<br>)+$/', '', $choice_d);
        }
        
        $title = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['title'], 1));
        $data['title'] = preg_replace('/(<br>)+$/', '', $title);
        
        if($data['explanation'] != null){
            $explanation = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['explanation'], 1));
            $data['explanation'] = preg_replace('/(<br>)+$/', '', $explanation);
        }
        
        $answer = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data[$data['answer']], 1)); 
        $data['answer'] = preg_replace('/(<br>)+$/', '', $answer);    

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . '/uploads/question/', $name); 
            $data['thumbnail'] = $name;            
        } 

        $question = new Question($data);        
        $question->save();

        return redirect('admin/question')->withType('success')->withMessage('Question Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findorfail($id);
        return view('admin.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findorfail($id);
        $categories = Category::where('status', 1)->pluck('title', 'id');
        return view('admin.question.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->email != 'arifkpi@gmail.com'){
            return 'Add/Edit/Delete disabled on Demo!';
        }

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'question_type' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png,bmp,gif',
            'number_of_answer'  => 'required',
            'choice_a' => 'required',
            'choice_b' => 'required',
            'choice_c' => 'required_if:number_of_answer,3|required_if:number_of_answer,4',
            'choice_d' => 'required_if:number_of_answer,4',            
            'answer' => 'required',
        ]);             

        $question = Question::findorfail($id);
        $data = $request->all(); 

        $choice_a = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_a'], 1));
        $data['choice_a'] = preg_replace('/(<br>)+$/', '', $choice_a);
        
        $choice_b = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_b'], 1));
        $data['choice_b'] = preg_replace('/(<br>)+$/', '', $choice_b);
        
        if($data['choice_c'] != null){
            $choice_c = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_c'], 1));
            $data['choice_c'] = preg_replace('/(<br>)+$/', '', $choice_c);
        }
        
        if($data['choice_d'] != null){
            $choice_d = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['choice_d'], 1));
            $data['choice_d'] = preg_replace('/(<br>)+$/', '', $choice_d);
        }
        
        $title = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['title'], 1));
        $data['title'] = preg_replace('/(<br>)+$/', '', $title);
        
        if($data['explanation'] != null){
            $explanation = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data['explanation'], 1));
            $data['explanation'] = preg_replace('/(<br>)+$/', '', $explanation);
        }
        
        $answer = trim(preg_replace('~<p>(.*?)</p>~is', '$1', $data[$data['answer']], 1)); 
        $data['answer'] = preg_replace('/(<br>)+$/', '', $answer);  

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . '/uploads/question/', $name); 
            $data['thumbnail'] = $name;         
        } 
        
        $question->update($data);        
        return redirect('admin/question')->withType('success')->withMessage('Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->email != 'arifkpi@gmail.com'){
            return 'Add/Edit/Delete disabled on Demo!';
        }
        $question = Question::findorfail($id);
        $question->destroy($id);
        return redirect('admin/question')->withType('danger')->withMessage('Question Deleted');
    }

    /**
     * Chnage status of the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status){
        if(Auth::user()->email != 'arifkpi@gmail.com'){
            return 'Add/Edit/Delete disabled on Demo!';
        }
        $question = Question::findorfail($id);
        if($status == 0){
            $data['status'] = 1;
            $message = 'Selected Question is Active now';
        }
        else{
            $data['status'] = 0;
            $message = 'Selected Question is Inactive now';
        }
        $question->update($data);
        return redirect('admin/question')->withType('success')->withMessage($message); 
    }

    /**
     * Chnage status of the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterCategory($id){
        if($id == 'all'){
            $questions = Question::orderBy('id', 'DESC')->paginate(10);
        }
        else{
            $questions = Question::orderBy('id', 'DESC')->where('category_id', $id)->paginate(10);
        }        
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->orderBy('title', 'ASC')->get();
        return view('admin.question.index', compact('questions', 'categories'));
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $title
     * @return \Illuminate\Http\Response
     */
    public function searchQuestion($title){
        $questions = Question::orderBy('id', 'DESC')->where('title', 'like', '%' . $title . '%')->paginate(10);
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->orderBy('title', 'ASC')->get();
        return view('admin.question.index', compact('questions', 'categories'));
    }
}
