<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, $roles)
    {
        
        // Check if user is logged in
        if ($request->session()->has('user_role') && $request->session()->get('user_role') === 'ADMIN') {
            // If the user is an admin, allow access    
             return redirect ('/')->with('error', 'Unauthorized! PLease login First'); // You can change this to any route you want

        }
             $userRole = $request->session()->get('user_role');

             $allowedRoles = explode('|', $roles);
              if(!in_array($userRole, $allowedRoles)){
                 return redirect('/')->with('error', 'Unauthorized! PLease login First'); // You can change this to any route you want
              }

    
                
        return $next($request);
            }

}
