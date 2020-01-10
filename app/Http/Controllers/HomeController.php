<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use XmlParser;

class HomeController extends SiteController
{
	public function index() {
		$this->template = 'home';
		$this->transparentHeader = true;

		return $this->output();
	}

	public function badbrowser() {
		return view('templates.badbrowser');
	}

	
	public function test() {
		$xml = XmlParser::load(storage_path('app/sneakerdark/').'import.xml');
		$xml->parse([
			[
				'trigger' => 'category',
				'pattern' => [
					'id' => ':id',
					'parentId' => ':parentId',
					'title' => 'category',
				],
				'callback' => function ($data) {

				}
			],
			[
				'trigger' => 'offer',
				'pattern' => [
					'article' => 'vendorcode',
					'price' => 'price',
					'categoryId' => 'categoryid',
					'pictures' => 'picture',
					'title' => 'name',
					'vendor' => 'vendor',
					'model' => 'model',
					'description' => 'description',
					'instock' => 'outlets.outlet:instock',
					'attributes' => [
						[
							'name' => 'param:name',
							'unit' => 'param:unit',
							'value' => 'param'
						]
					]
				],
				'callback' => function ($data) {

				}
			],
			[
				'trigger' => 'offer',
				'pattern' => [
					'attributes' => [
						[
							'name' => 'param:name',
							'unit' => 'param:unit',
							'value' => 'param'
						]
					]
				],
				'callback' => function ($data) {

				}
			]
		]);
		return;
	}
}
