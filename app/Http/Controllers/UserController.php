<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\Concerns\Has;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $path = Storage::disk("public")->putFile('/avatars', $request->file("avatar"));
        $user->avatar = $path;
        $user->save();
        return response()->json(["token"=>$user->createToken('api')->plainTextToken]);
    }

    public function login(UserLoginRequest $request){
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return response()->json(['token' => $user->createToken('api')->plainTextToken]);
        } else {
            return response()->json(['errors' => ["password"=>["Неверный логин или пароль"]]]);
        }
    }
}
