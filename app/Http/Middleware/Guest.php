<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;

use App\Customer;

class Guest
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
		if (is_null($request->cookie('guest_token'))) {
			$tokenBin;
			$token;

			do {
				$tokenBin = openssl_random_pseudo_bytes(40, $cstrong);
				$token = bin2hex($tokenBin);
				$token = substr($token, 0, 39);
			} while (Customer::where('guest_token', $token)->exists());

			$customer = new Customer;
			$customer->guest_token = $token;
			$customer->save();

			Cookie::queue(Cookie::forever('guest_token', $token));
		} else {
			$customer = Customer::where('guest_token', $request->cookie('guest_token'))->first();
			$customer->last_seen_at = time();
			$customer->save();
		}

		return $next($request);
	}
}
