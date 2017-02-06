<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('demo',function(Request $request){
    // return [
    //     'success' => "Update infomation successful.",
    //     'name' => "name",
    //     'email' => "email",
    //     'avatar' => "avatar"
    //         ];

    // $books = array('Alice in Wonderland','Tom Sawyer','Gulliver\'s Travels','Dracula','Leaves of Grass');
    // return Response::json($books);

    // return response()->json([
    //     'success' => "Update infomation successful.",
    //     'name' => "name",
    //     'email' => "email",
    //     'avatar' => "avatar"
    // ]);
// });
