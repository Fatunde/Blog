<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
   
    
        protected function authenticate($request, array $guards)
        {
            try {
                parent::authenticate($request, $guards);
            } catch (AuthenticationException $e) {
                throw new UnauthorizedHttpException('JWTAuth', $e->getMessage());
            }
        }
}
