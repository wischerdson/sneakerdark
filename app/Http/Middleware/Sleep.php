<?php

namespace App\Http\Middleware;

use Closure;

class Sleep
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	
		sleep(0); // 15 -> 8 -> -> 15 -> 9 -> 0
		return $next($request);
	}
}
