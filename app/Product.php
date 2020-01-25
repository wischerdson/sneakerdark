<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
	use Sluggable;

	protected $table = 'product';
	protected $guarded = [];
	public $timestamps = false;

	public function attributes()
	{
		return $this->hasMany('App\ProductAttribute');
	}
	public function description()
	{
		return $this->hasOne('App\ProductDescription');
	}
	public function images()
	{
		return $this->hasMany('App\ProductImage');
	}
	public function options()
	{
		return $this->hasMany('App\ProductOption');
	}

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'alias' => [
				'source' => ''
			]
		];
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
		/*static::addGlobalScope('age', function (Builder $builder) {
            $builder->where('age', '>', 200);
        });*/
	}
}
