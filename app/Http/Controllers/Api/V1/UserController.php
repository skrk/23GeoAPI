<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create ne user and generate token
     *
     * @return array
     */
    public function getToken(){
        $credentials = [
            'email' => 'admin@test.com',
            'password' => '!password'
        ];

        if(!Auth::attempt($credentials)){
            
            $user = new User();
            $user->name = 'admin';
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);
            $user->save();

            if(Auth::attempt($credentials)){
                /** @var \App\Models\User $user **/
                $user = Auth::user();
                
                $token = $user->createToken('token', ['create', 'update', 'delete']);

                return [
                    'token' => $token->plainTextToken
                ];
            }
        }
    }
}
