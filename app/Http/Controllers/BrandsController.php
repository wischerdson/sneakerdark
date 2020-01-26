<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandsController extends Controller
{
	public function index() {
		$this->template = 'brands';
		$this->title = 'Бренды - Sneakerdark';

		$brands = [
			'AAPE',                    'Adidas',        'Aeronautica',    'Alexander McQueen',
			'Anti Social Social Club', 'Arcteryx',      'Armani',         'Asics',
			'ASRV',                    'Balenciaga',    'Beats',          'Bogner', 
			'Burberry',                'Cafele',        'Canada Goose',   'Casio',
			'Caterpillar',             'Champion',      'Chanel',         'Columbia',
			'Converse',                'DGK',           'Diesel',         'Dior',
			'Dolce & Gabbana',         'Ecco',          'Emporio Armani', 'FILA',
			'Fjallraven Kanken',       'Forward',       'Gucci',          'Hoco',
			'HUF',                     'Hugo Boss',     'JBL',            'Jimmy Choo',
			'Lacoste',                 'Louis Vuitton', 'MDNS',           'Mechanix',
			'Monster',                 'Napapijri',     'Native',         'New Balance',
			'Nike',                    'OFF-WHITE',     'PALACE',         'PALLADIUM',
			'Parajumpers',             'Philipp Plein', 'PornHUB',        'Porsche design',
			'Prada',                   'Premiata',      'Puma',           'QuickSilver',
			'Ray Ban',                 'Reebok',        'Remain',         'Salomon',
			'Salvatore Ferragamo',     'SPALDING',      'Star Wars',      'Stussy',
			'Supreme',                 'Swarovski',     'Swissgear',      'The North Face',
			'THRASHER',                'Timberland',    'Tom Ford',       'Tommy Hilfiger',
			'Tommy Jeans',             'UGG',           'Under Armour',   'Vans',
			'Venum',                   'Versace',       'VLONE',          'Yeezy'
		];

		foreach ($brands as $brand) {
			$brand_2 = $this->toSnakeCase($brand);
			$this->vars['brands'][$brand] = [
				'image' => asset('image/brands/'.$brand_2.'.png'),
				'url' => route('brands.brand', ['brand' => $brand_2])
			];
		}

		return $this->output();
	}

	public function show($brand) {
		return $brand;
	}

	private function toSnakeCase($string) {
		$string = strtolower($string);
		return preg_replace('/\s/', '-', $string);
	}
}
