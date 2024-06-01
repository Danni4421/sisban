<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        $requestName = $request->getUri();
        $uri = last(explode('/', $requestName));

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                switch ($user->level) {
                    case "warga":
                        if ($uri === "login") {
                            return redirect()->to('/');
                        }
                        break;
                    case "admin":
                        return redirect()->to('/data-rw');
                    case "rt" || "rw":
                        return redirect($user->level);
                }
            }
        }

        return $next($request);
    }
}
