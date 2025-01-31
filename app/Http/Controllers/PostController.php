<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all(); = $posts = Post::get(); and we use order by to show the posts in an order like in our example latest first
        // we can use Post::orderby('created_at' , 'desc')->get(); or $posts = Post::latest()->get(); but in this way we show all the posts
        //for pagination we 
        $posts = Post::latest()->paginate(6);

        return view('posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'title'=>['required','max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:13000','mimes:png,jpg,webp']
        ]);

        //add the image if exists
        $path=null;
        if ($request->hasFile('image')) {
        $path = Storage::disk('public')->put('posts_images',$request->image);
        }

        //add the post
        Auth::user()->posts()->create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);

        //redirect
        return back()->with('success','your post added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //Gate::authorize() we make sure that the one who's editing the post is in fact the owner
        Gate::authorize('update',$post);
        return view('posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request ,Post $post)
    {
        //validate
        $request->validate([
            'title'=>['required','max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:13000','mimes:png,jpg,webp']
        ]);

        //update the photo
        $path=$post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images',$request->image);
            }

        //edit the post
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);

        //redirect
        return redirect()->route('dashboard')->with('success','your post added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {   
        Gate::authorize('update',$post);
        //delete imsage if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return back()->with('delete','Your post has been deleted');
    }
}
