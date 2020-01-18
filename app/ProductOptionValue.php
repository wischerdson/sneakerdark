<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    protected $table = 'product_option_value';
	protected $guarded = [];
	public $timestamps = false;

	public function product() {
		return $this->belongsTo('App\ProductOption');
	}
}
