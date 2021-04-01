<?php

namespace App\Http\Middleware;

use Closure, Auth, Exception;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleString)
    {
        //If User isn't logged in returns to login page
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        $roles = explode (".",$roleString);

        foreach($roles as $role) {
            if ($user->role->title === $role) {
                return $next($request);
            } 
        }
        abort(403);
    }
}
