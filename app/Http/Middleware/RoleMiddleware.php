<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // 1. Fetch user role and convert it to uppercase for consistency
        $userRole = strtoupper($request->session()->get('user_role', '')); 
        // Example: If session is 'admin', $userRole is 'ADMIN'
        // Example: If session is   'Teacher', $userRole is 'TEACHER'

        // 2. Authentication Check
        if (empty($userRole)) {
            return redirect('/login')->with('error', 'Please log in to access this page.');
        }

        // 3. ADMIN Bypass (Now checking the uppercase 'ADMIN')
        if ($userRole === 'ADMIN') {
            return $next($request); // <-- ADMIN is granted access regardless of route role
        }

        // 4. Standard Role Authorization Check
        // Convert the required roles from the route (e.g., 'admin' or 'teacher') to uppercase
        $allowedRoles = array_map('strtoupper', explode('|', $roles));
        
        // Check if the user's role is in the allowed list
   if (!in_array($userRole, $allowedRoles)) {
    // Role mismatch denial - Redirect the user to their known dashboard or the login page.
    
    // Check if the user is a Teacher and send them to the Teacher UI
    if ($userRole === 'TEACHER') {
        return redirect('/teacher/TeacherUI')->with('error', 'Access Denied. You do not have permission for that page.');
    }

    // Default denial: For any other role trying to access a page they shouldn't, 
    // send them to the base URL or the login page.
    return redirect('/login')->with('error', 'Access Denied. You do not have the required permissions.');
}
        // 5. Proceed
        return $next($request);
    }
}