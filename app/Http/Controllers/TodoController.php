<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        return Todo::orderBy('id','desc')->limit(5)->with('user')->get();
    }

    public function paginationListTodo(){
        $current_todo = request()->current_todo;
        $total_todo = Todo::all()->count();
        $todo = Todo::orderBy('id','desc')->limit(5)->offset($current_todo)->with('user')->get();
        if($todo){
            if($current_todo + 5 >= $total_todo ){
                return response()->json(['last' => $todo]);
            }else{
                return $todo;
            }
        }
    }

    public function todoCreateNew(){
        $validation = Validator::make(request()->all(),[
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required'
        ]);
        if($validation->fails()){
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $todo = new Todo;
            if(request()->hasFile('image')){
                $image = request()->file('image');
                $image_name= time().".".$image->guessClientExtension();
                $location = public_path('blog/'.$image_name);
                $edit_img = Image::make($image)->resize(600,400)->save($location,80);
                $todo->images = $image_name;
            }else{
                $todo->images = "default.jpg";
            }
            $content = Purifier::clean(request()->input('content'),'youtube');
            $todo->title = request()->input('title');
            $todo->content = $content;
            request()->user()->todo()->save($todo);
            $id_user = auth()->user()->id;
            $data = Todo::where('content',$content)->where('title',request()->input('title'))->where('user_id',$id_user)->with('user')->first();
            return ['success' => "Create new todo successful !",'data'=> $data];
        }
    }

    public function todoEdit(){
        $validation = Validator::make(request()->all(),[
            'title_edit' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content_edit' => 'required'
        ],[
             'title_edit.required' => 'The title field is required.',
             'content_edit.required' => 'The content field is required.'
        ]);
        if($validation->fails()){
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $todo = Todo::where('id',request()->input('id_edit'))->first();
            if(request()->hasFile('image')){
                if($todo->images != "default.jpg"){
                    Storage::delete('blog/'.$todo->images);
                }
                $image = request()->file('image');
                $image_name= time().".".$image->guessClientExtension();
                $location = public_path('blog/'.$image_name);
                $edit_img = Image::make($image)->resize(600,400)->save($location,80);
                $todo->images = $image_name;
            }
            $todo->title = request()->input('title_edit');
            $todo->content = Purifier::clean(request()->input('content_edit'),'youtube');
            $todo->update();
            return ['success' => "Edit todo successful !"];
        }
    }

    public function todoDelete(){
        $id = request()->id;
        $todo = Todo::where('id',$id)->first();
        if($todo->images != "default.jpg"){
            Storage::delete('blog/'.$todo->images);
        }
        $todo->delete();
        return ['success' => 'Delete todo successful !'];
    }
}
