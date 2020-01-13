<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
	protected $guarded = [];
	protected $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
