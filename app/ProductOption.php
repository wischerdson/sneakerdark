<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'product_option';
	protected $guarded = [];
	public $timestamps = false;

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function option()
	{
		return $this->belongsTo('App\Option');
	}

	public function customerCartsOptions()
	{
		return $this->hasMany('App\CustomerCartOption');
	}
}
