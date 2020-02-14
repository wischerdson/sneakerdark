<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CustomerCart extends Model
{
    protected $table = 'customer_cart';
	protected $guarded = [];
	public $timestamps = false;

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function customer()
	{
		return $this->belongsTo('App\Customer');
	}

	public function option()
	{
		return $this->hasOne('App\CustomerCartOption');
	}

	public static function boot()
	{
		self::creating(function ($model) {
			$model->created_at = time();
		});
		static::addGlobalScope('deleted', function (Builder $builder) {
			$builder->where('deleted_at', null);
		});

		parent::boot();
	}
}
