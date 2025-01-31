<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class dashboardController extends Controller
{
    public function index(){
        //this is the way i did my self and it's right and successful
        //$user_posts = Post::get()->where('user_id',Auth::user()->id);
        //the way i learned new was by using the User model or Auth and the posts method
        //but since posts method comes back with a hasMany relation we use it with out () so we get the posts of that user
        //$user_posts = Auth::user()->posts;
        //because we need ir oerdered by the newest we need th latest() method so we are going to put the ()
        $user_posts = Auth::user()->posts()->latest()->paginate(6);
        return view('users.dashboard',['user_posts'=>$user_posts]);
    }

    public function userPosts(User $user) {
        $user_posts = $user->posts()->latest()->paginate(10);
        return view('users.userPosts',[
            'user_posts'=>$user_posts,
            'user_name'=>$user->username,
    ]);
    }
}
