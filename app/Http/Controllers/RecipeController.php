<?php

namespace App\Http\Controllers;


use App\Http\Requests\RecipeAddRequest;
use App\Http\Requests\RecipeEditRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\Concerns\Has;

class RecipeController extends Controller
{
    public function postadd(RecipeAddRequest $request){
        $post = new Recipe();
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
        $post = Recipe::with('user')->withCount('likes','comments')->findOrFail($post);
        $comments = Comment::where("post_id", $post->id)->with('user')->get();
        $isLike = false;
        $isAdmin = false;
        if(Auth::check()){
            $like = Like::where("post_id",$post->id)->where("user_id", Auth::id())->first();
            if($like) {
                $isLike = true;
            }
            if(Auth::user()->id==$post->user_id||Auth::user()->role=='admin'){
                $isAdmin = true;
            }
        }
        return response()->json(['post'=>$post, 'comments'=>$comments, 'isAdmin'=>$isAdmin, 'isLike'=>$isLike]);
    }
    public function postedit(RecipeEditRequest $request, Recipe $post){
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
    public function postsUser(User $user){
        return Recipe::where("user_id",$user->id)->with("user")->withCount("comments","likes")->get();
    }
    public function postsHome(Request $request){
        $likeArray=[];
        if(isset($request->header()['userid'])){
            $likeArray = Like::where('user_id', $request->header()['userid'])->pluck('post_id')->toArray();
        }
        return ["posts"=>Recipe::with("user")->withCount("comments","likes")->paginate(2), "likesArray"=>$likeArray];
    }
}