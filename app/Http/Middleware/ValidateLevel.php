<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\matches;

class ValidateLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestName = $request->getUri();

        if (preg_match('/\/\/[^\/]+\/([^\/]+)/', $requestName, $matches)) {
            $role = $matches[1];

            if ($user_role = $this->validateLevel(role: $role)) {
                if ($user_role === "warga") {
                    return redirect()->to('/');
                }

                return redirect()->to(
                    $user_role === "admin" ? "admin/data-rw" : $user_role
                )->with('routeErrorMessage', 'Kamu tidak bisa mengakses yang bukan hak kamu');
            }
        }

        return $next($request);
    }

    private function validateLevel($role): bool | string
    {
        $authed_user_level = auth()->user()->level;

        if ($authed_user_level === $role) return false;

        return $authed_user_level;
    }
}
