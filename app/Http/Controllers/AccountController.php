<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use Auth;

class AccountController extends Controller
{
	public function index(Request $request) {

		$customer = Customer::with('personal_data')->find(Auth::guard('customer')->id());

		return view('account')->with([
			'links' => ['/css/account.css'],
			'customer' => $customer
		]);
	}
}
