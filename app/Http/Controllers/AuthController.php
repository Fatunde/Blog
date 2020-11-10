<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\User;


class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'sendPasswordResetLink', 'sendResetLinkResponse']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
            
        }
        

        return response()->json(['error' => 'Unauthorized'], 401);
        
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {     
        $user = Auth::user(); 
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(2);
        $viewposts = Auth::user()->posts()->orderBy('view', 'desc')->paginate(4);
        $allposts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
        
        
       $userdata = 
           [$user, $posts, $viewposts, $allposts];
       
       return $userdata;
    }

            
        /**
         * Send password reset link. 
         */
       
        public function sendPasswordResetLink(Request $request)
        {
            return $this->sendResetLinkEmail($request->input('email'));
        }

        protected function sendResetLinkResponse($response)
        {
            return response()->json([
                'message' => 'Password reset email sent.',
                'data' => $response
            ]);
        }
        protected function sendResetLinkFailedResponse($response)
        {
            return response()->json(['message' => 'Email could not be sent to this email address.']);
        }

    

    public function admin()

    {     
        $users = Auth::user()->with('posts')->orderBy('created_at', 'desc')->get();
        if (Gate::allows('isAdmin')) {

            return  $users;
    
        } else {
    
            return 'You are not Admin';
    
        }
    }

    public function index()

    {  
        $users = User::select('name', 'email', 'created_at', 'id', 'lastName', 'avatar', 'disable')->where('paid', 1)->where('activated', null)->get();
        if (Gate::allows('isAdmin')) {

            return  $users;
    
        } else {
    
            return 'You are not Admin';
    
        }
       
    }

    public function update(Request $request, $id)
    {      
            $user = User::find($id);
            if (Gate::allows('isUser')){          
            $user->paid = $request-> input(true);
            $user->save();
            return  "Payment Saved";
            } else {
    
            return 'Only Users can pay';
    
        }
        
    }
    
    public function indexes()
    {

        
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        if (Gate::allows('isAdmin')) {

            return  $posts;
    
        } else {
    
            return 'You are not Admin';
    
        }
        

      
    }

    public function activate(Request $request, $id)
    {
        if (Gate::allows('isAdmin')){
        $user = User::find($id);
        $user->activated = $request-> input('activated');
        $user->save();
        return "User Accepted";
        } else {
    
        return 'You are not an admin';

    }
    }

    public function destroy(Request $request, $id)
    
    {
        $user = User::find($id);
        
        if (Gate::allows('isAdmin')) {

            $user ->delete();
            return ('User Deleted');
    
        } else {
    
            return 'You are not Admin';
    
        }
      
    }
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    
 

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }


    
}
