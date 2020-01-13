<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'product';
	protected $guarded = [];
	protected $timestamps = false;

	public function attributes() {
		return $this->hasMany('App\ProductAttribute');
	}
	public function descriptions() {
		return $this->hasMany('App\ProductDescription');
	}
	public function images() {
		return $this->hasMany('App\ProductImage');
	}
	public function options() {
		return $this->hasMany('App\ProductOption');
	}
}
