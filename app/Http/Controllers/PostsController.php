<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
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
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        

        return  $posts;
    }

    public function mostRead()
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
        return ('Post Created');;     
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
        $post ->delete();
        return ('Post Removed');
    }
}
