<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
 /**
 * Handle an incoming request.
 *
 * @param \Illuminate\Http\Request $request
 * @param \Closure $next
 * @return mixed
 */
 public function handle($request, Closure $next)
 {
 if ($request->user() && $request->user()->is_admin) {
 return $next($request);
 }

return response()->json(['error' => 'Imposible acceder a este recurso no estas autorizado'], 403);
 }
}