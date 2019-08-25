<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Request;
use App\Http\Controllers\AuthController;
use Auth;

class Customer
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
		if (!Auth::guard('customer')->check()) {
			if (Request::ajax()) {
				return 'Unauthorized';
			}

			return new Response(AuthController::showLoginForm());
		}



		$customer = \App\CustomerPersonalData::find(Auth::guard('customer')->id());
		$customer->last_seen = time();
		$customer->save();

		return $next($request);
	}
}
