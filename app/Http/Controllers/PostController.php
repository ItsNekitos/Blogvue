<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostAddRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\Concerns\Has;

class PostController extends Controller
{
    public function postadd(PostAddRequest $request){
        $post = new Post();
        $post->user_id = Auth::id();
        $post->name = $request->name;
        $post->subtitle = $request->subtitle;
        $post->anons = $request->anons;
        $post->contentt = $request->contentt;
        $path = Storage::disk("public")->putFile('/photos', $request->file("photo"));
        $post->photo = $path;
        $post->save();
        return response()->json(["id"=>$post->id]);
    }
    public function post($post){
        $post = Post::with('user', 'comment')->findOrFail($post);
        return $post;
    }
}
