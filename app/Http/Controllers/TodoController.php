<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File;
use App\User;
use App\Todo;
use Validator;
use Purifier;
use Image;
class TodoController extends Controller
{
    public function view(){
        return view('components.todo');
    }
    public function listTodo(){
        return Todo::orderBy('id','desc')->limit(6)->with('user')->get();
    }

    public function paginationListTodo(Request $request){
        $current_todo = $request->current_todo;
        $total_todo = Todo::all()->count();
        $todo = Todo::orderBy('id','desc')->limit(6)->offset($current_todo)->with('user')->get();
        if($todo){
            if($current_todo + 6 >= $total_todo ){
                return response()->json(['last' => $todo]);
            }else{
                return $todo;
            }
        }
    }

    public function postCreateNew(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required'
        ]);
        if($validation->fails()){
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $id = $request->input('id');
            $title = $request->input('title');
            $content = Purifier::clean($request->input('content'));
            $todo = new Todo;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name= time().".".$image->getClientOriginalExtension();
                $location = public_path('blog/'.$image_name);
                $edit_img = Image::make($image)->resize(600,400)->save($location,80);
                $todo->images = $image_name;
            }
            $todo->title = $title;
            $todo->content = $content;
            // $request->user()->todo()->save($todo);
            return response()->json([
                'success' => "Create new tood successful !",
            ]);

            // Storage::delete(...)

        }
    }
}
