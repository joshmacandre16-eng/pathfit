<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AutoApproveUsers
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if ($request->is('register') && $request->isMethod('post')) {
            $email = $request->input('email');
            if ($email) {
                User::where('email', $email)
                    ->whereNull('email_verified_at')
                    ->update(['email_verified_at' => now()]);
            }
        }
        
        return $response;
    }
}
