<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount(['question'=>function($q) {
                        return $q->where('status', 1);
                    }])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $categories = Category::pluck('title', 'id');
        return view('admin.category.create', compact('categories'));
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
        $host_type = env("HOSTING_TYPE", "shared");

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png,bmp,gif',
            'quick' => 'required',
        ]);

        $data = $request->all();

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            if($host_type == 'shared'){
                $file->move(base_path() . '/uploads/category/', $name); 
            }
            else{
                $file->move(base_path() . '/public/uploads/category/', $name); 
            }
            $data['thumbnail'] = $name;            
        }        

        $category = new Category($data);        
        $category->save();
        return redirect('admin/category')->withType('success')->withMessage('Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);
        $categories = Category::where('id', '!=', $id)->pluck('title', 'id');
        return view('admin.category.edit', compact('category', 'categories'));
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
        $host_type = env("HOSTING_TYPE", "shared");

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png,bmp,gif',
            'quick' => 'required',
        ]);

        $category = Category::findorfail($id);
        $data = $request->all();

        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $mimes = $file->getClientMimeType();
            $name = time() . '.' . $file->getClientOriginalExtension();
            if($host_type == 'shared'){
                $file->move(base_path() . '/uploads/category/', $name); 
            }
            else{
                $file->move(base_path() . '/public/uploads/category/', $name); 
            }
            $data['thumbnail'] = $name;   
        }
        
        $category->update($data);        
        return redirect('admin/category')->withType('success')->withMessage('Category Updated');
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
        $category = Category::findorfail($id);
        $category->destroy($id);
        $category->question()->update(['status' => 0]);
        return redirect('admin/category')->withType('danger')->withMessage('Category Deleted');
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
        $category = Category::findorfail($id);
        if($status == 0){
            $data['status'] = 1;
            $message = 'Selected Category is Active now';
        }
        else{
            $data['status'] = 0;
            $message = 'Selected Category is Inactive now';
        }
        $category->update($data);
        return redirect('admin/category')->withType('success')->withMessage($message); 
    }
}
