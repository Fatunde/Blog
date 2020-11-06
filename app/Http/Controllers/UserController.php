<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {  
        $users = User::orderBy('post_counts', 'desc')->paginate(4);
        
        return  $users;
    }

    public function post_count( $id)
    {  
        $User = User::where('id', $id)->increment('post_counts', 1);
        return ("User posted");;
        //redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_counts = 0;
        $this->validate($request, 
        ['name' => 'required',
        'lastName' => 'required',
        'email' => 'required',
        'password' => 'required']);

        if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        } else{
            $name = "No Image";
        }
        
        $user = new User;
        $user->avatar = $request-> input($name);
        $user->name = $request-> input('name');
        $user->lastName = $request-> input('lastName');
        $user->email = $request-> input('email');
        $user->password = Hash::make($request-> input('password'));
        $user->post_counts = $post_counts;
        $user->save();
        return "User created";
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, $id)
    {
        
        $user = User::find($id);
        $user->disable = $request-> input('disabled');
        $user->save();  
        return ("User disabled");
    }
    public function enable(Request $request, $id)
    {
        
        $user = User::find($id);
        $user->disable = $request-> input('enabled');
        $user->save();  
        return ("User enabled");
    }
    public function update(Request $request, $id)
    {
        
        $user = User::find($id);
        $user->paid = $request-> input('paid');
        $user->save();
        return ("Payment Saved");
    }

    public function userUpdate(Request $request, $id)
    {
       

        $user = User::find($id);
        $user->name = $request-> input('name');
        $user->lastName = $request-> input('lastName');
        $user->email = $request-> input('email');
        $user->save();
        return ("User updated");
    }

    public function activate(Request $request, $id)
    {
        
        $user = User::find($id);
        $user->activated = $request-> input('activated');
        $user->save();
        return ("User Accepted");
    }

    public function postUser(Request $request, $id)
    {
        
        $user = User::find($id);
        $userPost = $user->name;
        return $userPost;
    }

    
    public function profilepicture(Request $request, $id)

    {
        $user = User::find($id);
        if($request->get('image'))
        {
           $image = $request->get('image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('image'))->save(public_path('images/').$name);
         }


        $user->avatar = $name;
        $user->save();
        return "saved";
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    
    {
        $user = User::find($id);
        $user ->delete();
        return ('User Deleted');
      
    }
}
