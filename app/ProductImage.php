<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
	protected $guarded = [];
	public $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
