<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use Route;
use App\User;
use Auth;
use App\Tutorial;
use App\gdpr;
use Maatwebsite\Excel\Facades\Excel;

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

    public function gdpr(){
        $gdpr = gdpr::orderBy('id', 'DESC')->first();
        return view('admin.gdpr', compact('gdpr'));
    }

    public function profile(){
        $users = User::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.profile', compact('users'));
    }

    public function tutorial(){
        $tutorial = Tutorial::orderBy('id', 'DESC')->first();
        return view('admin.tutorial.index', compact('tutorial'));
    }

    public function addTutorial(Request $request){
        $this->validate($request, [
            'content' => 'required',
        ]);
        $data = $request->all();

        $tutorial = Tutorial::orderBy('id', 'DESC')->limit(1)->get();

        if(count($tutorial) > 0){
            $id = $tutorial[0]->id;
            $tutorial = Tutorial::findorfail($id);
            $tutorial->update($data);        
            return redirect('admin/tutorial')->withType('success')->withMessage('Tutorial Updated');
        }
        else{
            $tutorial = new Tutorial($data);        
            $tutorial->save();
            return redirect('admin/tutorial')->withType('success')->withMessage('Tutorial Added');
        }        
    }

    public function addGdpr(Request $request){
        $this->validate($request, [
            'content' => 'required',
        ]);
        $data = $request->all();

        $gdpr = gdpr::orderBy('id', 'DESC')->limit(1)->get();

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . '/uploads/gdpr/', $name); 
            $data['thumbnail'] = $name;            
        }  

        if(count($gdpr) > 0){
            $id = $gdpr[0]->id;
            $gdpr = gdpr::findorfail($id);
            $gdpr->update($data);        
            return redirect('admin/gdpr')->withType('success')->withMessage('GDPR Updated');
        }
        else{
            $gdpr = new gdpr($data);        
            $gdpr->save();
            return redirect('admin/gdpr')->withType('success')->withMessage('GDPR Added');
        }        
    }

    public function notification(){
        return view('admin.notification');
    }

    public function upload(){
        $categories = Category::where('status', 1)->pluck('title', 'id');
        return view('admin.upload', compact('categories'));
    }

    public function uploadData(Request $request){   
        $this->validate($request, [
            'category_id' => 'required',
            'upload_file' => 'required'
        ]);    

        $data = $request->all();        
        \Session::put('category_id', $data['category_id']);

        if($request->file('upload_file')){
            $file = $request->file('upload_file');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . '/uploads/bulkupload/', $name); 
            $data['upload_file'] = base_path() . '/uploads/bulkupload/' . $name;          
        }    

        try {
            Excel::load($data['upload_file'], function ($reader) {
                $cat_id = \Session::get('category_id');

                foreach ($reader->toArray() as $key => $question) {   
                    $number_of_answer = 0;
                    if(!empty($question['choice_a'])){
                        $number_of_answer++;
                    }
                    if(!empty($question['choice_b'])){
                        $number_of_answer++;
                    }
                    if(!empty($question['choice_c'])){
                        $number_of_answer++;
                    }
                    if(!empty($question['choice_d'])){
                        $number_of_answer++;
                    }
                    if(!empty($question['choice_e'])){
                        $number_of_answer++;
                    }
                    $question['number_of_answer'] = $number_of_answer;
                    $question['category_id'] = $cat_id;
                    $question['choice_a'] = trim($question['choice_a']);
                    $question['choice_b'] = trim($question['choice_b']);
                    $question['choice_c'] = trim($question['choice_c']);
                    $question['choice_d'] = trim($question['choice_d']);
                    $question['choice_e'] = trim($question['choice_e']);
                    $question['answer'] = trim($question['answer']);
                    $question['thumbnail'] = trim($question['thumbnail']);
                    $question['title'] = trim($question['title']);
                    $question['explanation'] = trim($question['explanation']);
                    if(!empty($question['thumbnail'])){
                        $question['question_type'] = 'photo';
                    }

                    $options = [$question['choice_a'], $question['choice_b'], $question['choice_c'], $question['choice_d'], $question['choice_e']];

                    if(in_array($question['answer'], $options)){
                        $question = new Question($question);
                        $question->save();      
                    }
                }
            });

            unlink($data['upload_file']);
            return redirect('admin/upload')->withType('success')->withMessage('Questions Data Added');   
        }
        catch(\Exception $e){
            return redirect('admin/upload')->withType('danger')->withMessage($e->getMessage());   
        }
    }

    public function sendNotification(Request $request){
        $key = env("FIREBASE_API_SERVER_KEY", "");

        if(!empty($key)){
            $this->validate($request, [
                'title' => 'required',
                'message' => 'required',
            ]);
            
            $data = array("to" => "/topics/quizix", "notification" => array( "title" => $request['title'], "body" => $request['message'], "sound" => $request['sound']));                                                                    
            //$data_string = json_encode($data); 
            //return "The Json Data : ".$data_string; 

            $url = 'https://fcm.googleapis.com/fcm/send';
     
            $headers = array(
                'Authorization: key=' . $key,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $result = curl_exec($ch);
            if($result === FALSE){
                die('Sending Push Notification Failed: ' . curl_error($ch));
                return false;
            }
     
            curl_close($ch);

            // return $result;
     
            return redirect('admin/notification')->withType('success')->withMessage('Push Notification Sent!');
        }
        else{
            return 'Enter Your Firebase Server API Key on the .env File First!';
        }
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
            'uname' => 'required|string|max:255',
            'uemail' => 'required|string|email|max:255',
            'upassword' => 'required|string|min:6|confirmed',
        ]);

        $id = \Auth::user()->id;
        $user = User::findorfail($id);

        $data = array();
        $data['name'] = $request['uname'];
        $data['email'] = $request['uemail'];
        $data['password'] = bcrypt($request['upassword']);
        
        $user->update($data);        
        return redirect('admin/profile')->withType('success')->withMessage('Profile Updated');
    }

    public function deleteUser(Request $request){
        $data = $request->all();
        $user = User::findorfail($data['user_id']);
        $user->destroy($data['user_id']);
        return redirect('admin/profile')->withType('danger')->withMessage('User Deleted');
    }

    public function apiShowCategories(){
        $categories = Category::withCount(['question'=>function($q) {
                return $q->where('status', 1);
            }])->orderBy('position', 'ASC')->withCount('children')->orderBy('title', 'ASC')->where('status', 1)->where('parent_id', null)->get();
        return $categories;
    }

    public function apiShowCategoriesPremium(){
        $categories = Category::withCount(['question'=>function($q) {
            return $q->where('status', 1);
        }])->orderBy('position', 'ASC')->withCount('children')->orderBy('title', 'ASC')->where('paid', 1)->where('status', 1)->where('parent_id', null)->get();   
        return $categories;
    }

    public function apiShowCategoriesFree(){
        $categories = Category::withCount(['question'=>function($q) {
            return $q->where('status', 1);
        }])->orderBy('position', 'ASC')->withCount('children')->orderBy('title', 'ASC')->where('paid', 0)->where('status', 1)->where('parent_id', null)->get();   
        return $categories;
    }

    public function apiShowChildCategories($id){
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->withCount('children')->orderBy('position', 'ASC')->where('status', 1)->where('parent_id', $id)->get();
        return $categories;
    }

    public function apiShowChildCategoriesPremium($id){
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->withCount('children')->orderBy('position', 'ASC')->where('paid', 1)->where('status', 1)->where('parent_id', $id)->get();
        return $categories;
    }

    public function apiShowChildCategoriesFree($id){
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->withCount('children')->orderBy('position', 'ASC')->where('paid', 0)->where('status', 1)->where('parent_id', $id)->get();
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
        $question = Question::findorfail($id);      
        return $question;
    }

    public function apiShowTutorial(){
        $tutorial = Tutorial::orderBy('id', 'DESC')->first();
        return $tutorial;
    }
}
