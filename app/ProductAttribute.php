<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attribute';
	protected $guarded = [];
	protected $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
