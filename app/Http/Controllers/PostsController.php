<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\User;
use Carbon\Carbon;





class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        

        return  $posts;
    }
    public function index4()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        

        return  $posts;
    }

    public function mostRead()
    {
        
        $posts = Post::orderBy('view', 'desc')->paginate(10);
        

        return  $posts;
    }
    public function mostRead3()
    {
        
        $posts = Post::orderBy('view', 'desc')->paginate(3);
        

        return  $posts;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        } else {$name = "No image";
    }
        

        $this->validate($request, 
        ['title' => 'required',
        'body' => 'required']);
        $post = new Post;
        $post->title = $request-> input('title');
        $post->body = $request-> input('body');
        $post->user_id = $request-> input('id');
        $post->user_name = $request-> input('name');
        $post->image = $name;
        $post->save();

        $id = $post->user_id;
        User::where('id', $id)->increment('post_counts', 1);
        return ('Post Created');;     
    }
    public function postImage(Request $request, $id)   
    {
        
        if($request->get('image'))
        {
           $image = $request->get('image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('image'))->store('public/images').$name;
         }else {
             $name = "No image";
         }
        $post = Post::find($id);
        $post->image = $request-> input($name);
        $post->save();
        return "Done";
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  \Log::info($id);
        $post = Post::find($id);
        return $post;
    }

    public function userPost(Request $request, $user_id)
    {
      
      $posts = Post::where("user_id", $user_id)->get();
      return $posts;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $this->authorize('isUser');
        $post = Post::find($id);
        return ($post);
    
        
    
       
    
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
        ['title' => 'required',
        'body' => 'required']);
        
        $post = Post::find($id);
        $post->title = $request-> input('title');
        $post->body = $request-> input('body');
        $post->save();
        return ("Post Updated");;
        //redirect('/posts')->with('success', 'Post Updated');
    }
    public function read(Request $request, $id)
    {
      
        
        $post = Post::where('id', $id)->increment('view', 1);
        return ("Post Updated");;
        //redirect('/posts')->with('success', 'Post Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $post = Post::find($id);
        $user_id = $post->user_id;
        $post ->delete();
        
        User::where('id', $user_id)->decrement('post_counts', 1);
        return ('Post Removed');
    }
}
