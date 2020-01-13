<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'product_option';
	protected $guarded = [];
	protected $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
	public function values() {
		return $this->hasMany('App\ProductOptionValue');
	}
}
