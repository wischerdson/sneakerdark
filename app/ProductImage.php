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

	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->created_at = time();
			$model->updated_at = time();
		});
		self::updating(function($model) {
			$model->updated_at = time();
		});
	}
}
