@extends("layouts.app")

@section("content")
  
<div class="container bg-white">
        <form class="box  p-2">
            <div class="input-group input-group-lg p-2 ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><small>First Name</small> </span>
                </div>
                <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
              </div>
                <div class="input-group input-group-lg p-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-lg"><small>Last Name</small></span>
                    </div>
                    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                  </div>
            <div class="input-group input-group-lg p-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><small>Email</small></span>
                </div>
                <input type="email" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
              </div>
              <div class="input-group input-group-lg p-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><small>Create Password</small></span>
                </div>
                <input type="password" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
              </div>
              <div class="input-group input-group-lg p-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><small>Re-Password</small></span>
                </div>
                <input type="password" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
              </div><div class="d-flex justify-content-between p-2" >
              <button type="submit" class="btn btn-primary">Register</button>
              <diV class="text-primary"><small>Already have an account?</small>
                <a class="btn btn-primary" href="/login" role="button">Login</a>
              </diV></div>
              
          </form>
        </div>
   @endsection
