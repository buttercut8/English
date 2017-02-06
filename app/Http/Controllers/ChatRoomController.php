<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chatroom;
use App\Events\MessagePosted;
use Auth;
class ChatRoomController extends Controller
{
    public function listMessage(){
        return Chatroom::with('user')->get();
    }

    public function sendMessage(){
        // $chatroom = new Chatroom;
        $user = Auth::user();
        // $chatroom->message = request()->message;
        // $success = request()->user()->chatroom()->save($chatroom);
        $chatroom = $user->chatroom()->create([
            'message' => request()->get('message')
        ]);
        // event(new MessagePosted($chatroom,$user));

        broadcast(new MessagePosted($chatroom, $user))->toOthers();

        if($chatroom){
            return ['success' => 'good'];
        }else{
            return ['errors' => 'Message is sent failed'];
        }

    }

    public function editMessage($id){
        $chatroom = Chatroom::where('id',$id)->first();
        // $success = $chatroom->delete();
        // if($success){
        //     return ['success' => 'Delete message successful !'];
        // }else{
        //     return ['errors' => 'Delete message failed'];
        // }
    }


    public function deleteMessage($id){
        $chatroom = Chatroom::where('id',$id)->first();
        $success = $chatroom->delete();
        if($success){
            return ['success' => 'Delete message successful !'];
        }else{
            return ['errors' => 'Delete message failed'];
        }
    }
}
