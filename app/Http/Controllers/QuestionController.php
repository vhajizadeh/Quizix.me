<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;

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
        return view('admin.question.index', compact('questions'));
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
        $host_type = env("HOSTING_TYPE", "shared");

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
        $data['answer'] = $data[$data['answer']];

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            if($host_type == 'shared'){
                $file->move(base_path() . '/uploads/question/', $name); 
            }
            else{
                $file->move(base_path() . '/public/uploads/question/', $name); 
            }
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
        $host_type = env("HOSTING_TYPE", "shared");

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
        $data['answer'] = $data[$data['answer']];

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            if($host_type == 'shared'){
                $file->move(base_path() . '/uploads/question/', $name); 
            }
            else{
                $file->move(base_path() . '/public/uploads/question/', $name); 
            }
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
}
