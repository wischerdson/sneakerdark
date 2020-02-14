<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customer';
	protected $guarded = [];
	public $timestamps = false;

	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->created_at = time();
			$model->last_seen_at = time();
		});
	}
}
