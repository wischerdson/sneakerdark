<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
	public function sizes()
	{
		return $this->hasMany('App\ProductOption')->whereHas('option', function (Builder $query) {
			$query->whereIn('name', [
				'Размер обуви',
				'Размер одежды',
				'Размер Аксессуаров'
			]);
		});
	}
	public function scopeWithAttributes($query)
	{
		return $query->with(['attributes' => function ($q1) {
			$q1
			->join('attribute', 'product_attribute.attribute_id', '=', 'attribute.id')
			->orderBy('attribute.sort_order', 'asc');
		}]);
	}
	public function scopeWithOptions($query)
	{
		return $query->with(['options' => function ($q1) {
			$q1->
			where('instock', '>', 0)->
			with('option');
		}]);
	}
	public function scopeColors($query, $model)
	{
		return $query->join('product_description', 'product.id', '=', 'product_description.id')->where('product_description.model', $model);
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
		/*static::addGlobalScope('deleted', function (Builder $builder) {
			$builder->where('deleted_at', null);
		});*/
	}
}
