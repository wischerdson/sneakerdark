<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Crypt;

use VK\Client\VKApiClient;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;
use VK\OAuth\Scopes\VKOAuthUserScope;

use App\Customer;
use App\CustomerPersonalData;

use Auth;
use Crypt;
use View;

class AuthController extends Controller
{
	public static function showLoginForm() {
		return view('account-auth-login')->with([
			'links' => ['/css/account.auth.login.css'],
			'title' => 'Вход - Sneakerdark'
		]);
	}
	public function showRegisterForm() {
		return view('account-auth-register')->with([
			'links' => ['/css/account.auth.register.css'],
			'title' => 'Регистрация - Sneakerdark'
		]);
	}


	public function loginVk() {
		$oauth = new VKOAuth();

		$client_id = config('app.vk_client_id');
		$redirect_uri = route('account.login.vk.access_token');
		$display = VKOAuthDisplay::PAGE;
		$scope = array(VKOAuthUserScope::OFFLINE, VKOAuthUserScope::EMAIL);

		$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope);

		return redirect($browser_url);
	}

	public function vkAccessToken(Request $request) {
		$oauth = new VKOAuth();
		$client_id = config('app.vk_client_id');
		$client_secret = config('app.vk_client_secret');
		$redirect_uri = route('account.login.vk.access_token');
		$code = $request->input('code');

		$response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
		$access_token = $response['access_token'];
		$email = $response['email'];
		$user_id = $response['user_id'];

		$vk = new VKApiClient();
		$response = $vk->users()->get($access_token, [
			'fields' => ['sex', 'city', 'country']
		])[0];

		$customer = Customer::firstOrCreate(['login' => $response['id']], [
			'registration_method' => 'vk',
			'login' => $response['id']
		]);
		CustomerPersonalData::firstOrCreate(['customer_id' => $customer->id], [
			'customer_id' => $customer->id,
			'first_name' => $response['first_name'],
			'last_name' => $response['last_name'],
			'email' => $email,
			'email_verified' => $email ? 1 : 0,
			'gender' => (string) $response['sex'],
			'created_at' => time(),
			'last_seen' => time()
		]);
		Auth::guard('customer')->loginUsingId($customer->id, true);

		return redirect( route('account') );
	}

	public function authenticate($credentials) {

	}
	public function register(Request $request) {
		$request = $request->input();
		
		$customer = Customer::where('login', $request['email'])->first();

		if (!empty($customer)) {
			return [
				'status' => 'error',
				'error_whose' => 'email',
				'error_type' => 'email_exists'
			];
		}

		$customer = Customer::create([
			'registration_method' => $request['registration_method'],
			'login' => $request['email'],
			'password' => Crypt::encryptString($request['password'])
		]);
		$explodedName = explode(' ', $request['name']);
		CustomerPersonalData::create([
			'customer_id' => $customer->id,
			'first_name' => $explodedName[0],
			'last_name' => $explodedName[1],
			'patronymic' => isset($explodedName[2]) ? $explodedName[2] : null,
			'email' => $request['email'],
			'phone' => $request['phone'],
			'email_verified' => 0,
			'gender' => '0',
			'created_at' => time(),
			'last_seen' => time()
		]);

		Auth::guard('customer')->loginUsingId($customer->id, true);
		return route('account');
	}

	public function logout() {
		Auth::guard('customer')->logout();
		return redirect( route('account') );
	}
}