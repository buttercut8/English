<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\MessageBag;
use App\User;
use Validator;
use Image;
class UserController extends Controller
{
    public function getLogin(){
        return view('components/login');
    }
    public function postLogin(){
        $validation = Validator::make(request()->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validation->fails()){
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $email = request()->input('email');
            $password = request()->input('password');
            if(Auth::attempt(['email' => $email,'password' => $password ],request()->has('remember'))
            || Auth::attempt(['phone' => $email,'password' => $password ],request()->has('remember'))
            )
            {
                return response()->json(['login' => route('todo.view')],200);
            }else{
                return response()->json(['error_login' => 'Email or password not true !'],200);
            }
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
    public function infomationUser(){
        return User::where('id',request()->id)->first();
    }
    public function editPassword(){
        $validation = Validator::make(request()->all(),[
            'passCurrent' => 'required',
            'passNew' => 'required | min:6',
            'passConfirm' => 'required | same:passNew'
        ],[
            'passCurrent.required' => 'The password current field is required.',
            'passNew.required' => 'The password new field is required.',
            'passNew.min' => 'The password new must be at least 6 characters.',
            'passConfirm.required' => 'The re-type password field is required.',
            'passConfirm.same' => 'The password new and re-type password must match.',
        ]);
        if($validation->fails()){
            // return response()->json(['errors' => $validation->getMessageBag()->toArray()]);
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $passCurrent = request()->input('passCurrent');
            $passNew = request()->input('passConfirm');
            $id = request()->id;
            $users = User::where('id',$id)->first();
            if(Hash::check($passCurrent,$users->password)){
                $users->password = Hash::make($passNew);
                $users->update();
                return response()->json([
                      'message' => 'Change password successful !',
                      'url' => route('user.login'),
                      'confirm' => 'You may want to sign back ?',
                ]);
            }else{
                return response()->json(['error_pass' => 'Password current not true !'],200);
            }
        }
    }

    public function updateAccount(){
        $validation = Validator::make(request()->all(),[
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' =>  'required',
            'email' => 'required | email',
            'phone' => 'required | numeric',
        ]);
        if($validation->fails()){
            return ['errors' => $validation->errors()->toArray()];
        }else{
            $users = User::where('id',request()->id)->first();
            if(request()->hasFile('avatar')){
                $file = request()->file('avatar');
                $file_name = time().'.'.$file->guessClientExtension();

                $edit_file = Image::make($file);
                $edit_file->resize(null,130,function($ratio){
                    $ratio->aspectRatio();
                });
                $location = public_path('avatar/'.$file_name);
                $upload_file = $edit_file->save($location,80);
                if($users->avatar != "avatar.png"){
                    unlink(public_path()."/avatar/".$users->avatar);
                }
                $users->avatar = $file_name;
            }
            $users->name = request()->input('name');
            $users->phone = request()->input('phone');
            $users->email = request()->input('email');
            $users->facebook = request()->input('facebook');
            $users->twitter = request()->input('twitter');
            $users->skype = request()->input('skype');
            $users->about_me = request()->input('about_me');
            $users->update();
            return response()->json([
                'success' => "Update infomation successful.",
                'avatar' => $file_name
            ]);
        }
    }

    public function updateBackground(){

          $validate = Validator::make(request()->all(),[
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2548'
          ]);
          if($validate->fails()){
               return ['errors' => $validate->errors()->first()];
          }else{
                if(request()->hasFile('image')){
                  $image = request()->file('image');
                  $image_name = time().".".$image->guessClientExtension();
                  // $location = public_path('background/'.$image_name);
                  // $edit_image = Image::make($image)->resize('550','365')->save($location);
                  $location = public_path('background');
                  $save =  $image->move($location,$image_name);
                  $user = User::where('id',request()->id)->first();
                  if($user->background != "background.jpg"){
                        Storage::delete('background/'.$user->background);
                  }
                  $user->background = $image_name;
                  $user->update();
                  return ['success' => 'Upload background successful '];
                }
          }
     }


     public function addMember(){
         $validate = Validator::make(request()->all(),[
             'name' => 'required',
             'phone' => 'required | numeric',
             'email' => 'required | email',
             'password' => 'required | min:4',
         ]);
            if($validate->fails()){
                return ['errors' => $validate->errors()->first()];
            }else{
                $member =new User;
                $member->remember_token	= str_random(100);
                $member->ip_address	= $this->get_client_ip();
                $member->name = request()->name;
                $member->phone = request()->phone;
                $member->email = request()->email;
                $member->password = bcrypt(request()->password);
                $member->save();
                return ['success' => "Add new member successful !"];
            }
     }
     function get_client_ip() {
         $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



}



// 'name' =>  'required | regex:/^[a-zA-Z0-9[:space:]]+$/', kí tự ko dấu
//          'phone' => ['required', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}+$/'],
//          'email' => ['required', 'regex:/^[a-z]+$/'],
// $upload_file = $file->store('avatars');
// Storage::disk('local')->put($file_name,File::get($file));
// $success = Storage::disk('local')->get($file_name);
