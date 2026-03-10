<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $post = Post::with('user')->findOrFail($post);
        $comments = Comment::where("post_id", $post->id)->with('user')->get();
        $isAdmin = false;
        if(Auth::check()){
            if(Auth::user()->id==$post->user_id||Auth::user()->role=='admin'){
                $isAdmin = true;
            }
        }
        return response()->json(['post'=>$post, 'comments'=>$comments, 'isAdmin'=>$isAdmin]);
    }
    public function postedit(PostEditRequest $request, Post $post){
        $post->name = $request->name;
        $post->subtitle = $request->subtitle;
        $post->anons = $request->anons;
        $post->contentt = $request->contentt;
        if ($request->has("photo")){
            $path = Storage::disk("public")->putFile('/photos', $request->file("photo"));
            $post->photo = $path;
        }
        $post->save();
        return response()->json(["id"=>$post->id]);
    }
    public function postUser(User $user){
        return Post::where("user_id",$user->id)->with("user")->withCount("comments","likes")->get();
    }
}