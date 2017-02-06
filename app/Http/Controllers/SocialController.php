<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use App\Social;
use App\User;
use Auth;
class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);
        $selectProvider = Social::where('provider_id',$user->getId())->first();
        if(!$selectProvider){
            $userGetReal = User::where('email',$user->getEmail())->first();
            if(!$userGetReal){
                $userGetReal = new User();
                $userGetReal->email = $user->getEmail();
                $userGetReal->name = $user->getName();
                // $userGetReal->avatar = $user->avatar_original;
                $userGetReal->ip_address = $userGetReal->get_client_ip();
                $userGetReal->save();
            }
            $newprovider = new Social();
            $newprovider->provider_id = $user->getId();
            $newprovider->provider = $provider;
            $newprovider->user_id = $userGetReal->id;
            $newprovider->save();
        }else{
            // login user
            $userGetReal = User::find($selectProvider->user_id);
        }
        auth()->login($userGetReal);
        return redirect()->route('todo.view');
    }
}
