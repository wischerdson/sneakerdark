<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
