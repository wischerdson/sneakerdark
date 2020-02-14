<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Product;
use App\Customer;
use App\CustomerCart;
use App\CustomerCartOption;

use App\Http\Resources\CartResource;

class CartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//dd($request->input());
		$guest = $request->cookie('guest_token');
		$customer = Customer::where('guest_token', $guest)->select('id')->first();
		if (!$customer)
			return 'Invalid guest token';

		$customerCart = CustomerCart::where('customer_id', $customer->id)->with('option')->get();

		return CartResource::collection($customerCart);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$guest = $request->cookie('guest_token');
		$customer = Customer::where('guest_token', $guest)->select('id')->first();
		if (!$customer)
			return 'Invalid guest token';

		$product = (object) $request->input('params');

		$productHasOptions = Product::
			where('id', $product->product_id)->
			has('options')->
			exists();

		if ($productHasOptions and !$product->option_id)
			return 'Required product option id';


		$productAdded = CustomerCart::
			where('customer_id', $customer->id)->
			where('product_id', $product->product_id)->
			when(!is_null($product->option_id), function ($query1) use ($product) {
				return $query1->
				whereHas('option', function (Builder $query2) use ($product) {
					$query2->where('product_option_id', $product->option_id);
				});
			})
			->first();

		if ($productAdded) {
			$productAdded->increment('quantity');
			return $productAdded->id;
		}

		$customerCart = new CustomerCart;
		$customerCart->product_id = $product->product_id;
		$customerCart->customer_id = $customer->id;
		$customerCart->save();

		if (!is_null($product->option_id)) {
			$customerCartOption = new CustomerCartOption;
			$customerCartOption->customer_cart_id = $customerCart->id;
			$customerCartOption->product_option_id = $product->option_id;
			$customerCartOption->save();
		}

		return $customerCart->id;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
