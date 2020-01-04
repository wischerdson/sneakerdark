<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Size;

class CartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$productsIds = [];
		$productsR = (array) json_decode($request->input('products'));
		//return $productsR;
		foreach ($productsR as $key => $value) {
			$productsIds[] = $key;
		}


		$products = Product::
			whereIn('id', $productsIds)
			->withoutGlobalScopes()
			->with(['pictures' => function ($q) {
				return $q->first();
			}, 'parameters' => function ($q) {
				return $q->where('key', 'Цвет')->first();
			}])
			->get();

		$result = [];
		foreach ($products as $product) {
			$size = $productsR[$product->id]->size;
			$quantity = $productsR[$product->id]->quantity;
			$size = Size::find($size);

			$result[] = [
				'id' => $product->id,
				'price' => $product->price,
				'size' => [
					'size' => $size ? $size->size : '',
					'instock' => $size ? $size->instock : 10
				],
				'picture' => $product->pictures,
				'quantity' => $quantity,
				'name' => $product->title,
				'vendor' => $product->vendor,
				'color' => $product->parameters
			];
		}

		return $result;

		return [
			'products' => [
				[
					'id' => 18047,
					'price' => 1450,
					'size' => 54,
					'picture' => 'https://...',
					'quantity' => 5,
					'name' => 'Поло Lacoste',
					'vendor' => 'Lacoste',
					'color' => 'Черный'
				]
			]
		];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
