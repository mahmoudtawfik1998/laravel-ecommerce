<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق من أن المستخدم مسجل دخول
        if (!auth()->check()) {
            return redirect('/login');
        }

        // تحقق من أن المستخدم أدمن
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح لك بالدخول لهذه الصفحة');
        }

        return $next($request);
    }
}