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

    // Remove Unnecessary HTML or Space
    public function format_html_string($content){
        $remove_tags = trim(strip_tags($content, '<sub><sup>'));   
        $output = preg_replace('~
         (?>
            <(\w++)[^>]*+>(?>\s++|&nbsp;|<br\s*+/?>)*</\1>  # empty tags
           |                                                # OR
            (?>\s++|&nbsp;|<br\s*+/?>)+                     # white spaces, br, &nbsp;
         )+$
                        ~xi', '', $remove_tags);  

        return $output;
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
            'choice_d' => 'required_if:number_of_answer,4|required_if:number_of_answer,5',
            'choice_e' => 'required_if:number_of_answer,5',          
            'answer' => 'required',
        ]);             

        $data = $request->all();
         
        $data['title'] = $this->format_html_string($data['title']); 
        $data['choice_a'] = $this->format_html_string($data['choice_a']); 
        $data['choice_b'] = $this->format_html_string($data['choice_b']);       
        
        if($data['choice_c'] != null){
             $data['choice_c'] = $this->format_html_string($data['choice_c']); 
        }        
        if($data['choice_d'] != null){
             $data['choice_d'] = $this->format_html_string($data['choice_d']); 
        }  
        if($data['choice_e'] != null){
             $data['choice_e'] = $this->format_html_string($data['choice_e']); 
        }        
        if($data['explanation'] != null){
            $data['explanation'] = $this->format_html_string($data['explanation']); 
        }        
        $data['answer'] = $this->format_html_string($data[$data['answer']]); 

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
            'choice_d' => 'required_if:number_of_answer,4|required_if:number_of_answer,5',
            'choice_e' => 'required_if:number_of_answer,5',             
            'answer' => 'required',
        ]);             

        $question = Question::findorfail($id);
        $data = $request->all(); 

        $data['title'] = $this->format_html_string($data['title']); 
        $data['choice_a'] = $this->format_html_string($data['choice_a']); 
        $data['choice_b'] = $this->format_html_string($data['choice_b']);       
        
        if($data['choice_c'] != null){
             $data['choice_c'] = $this->format_html_string($data['choice_c']); 
        }        
        if($data['choice_d'] != null){
             $data['choice_d'] = $this->format_html_string($data['choice_d']); 
        }        
        if($data['choice_e'] != null){
             $data['choice_e'] = $this->format_html_string($data['choice_e']); 
        } 
        if($data['explanation'] != null){
            $data['explanation'] = $this->format_html_string($data['explanation']); 
        }      
        $data['answer'] = $this->format_html_string($data[$data['answer']]); 

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
