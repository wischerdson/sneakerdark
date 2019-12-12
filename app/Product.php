<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
	protected $table = 'products';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;


	protected static function boot() {
		parent::boot();

		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('created_at', 'desc');
		});
	}


	public function collection() {
		return $this->belongsTo('App\Collection', 'collection_id', 'id');
	}
	public function parameters() {
		return $this->hasMany('App\Parameter');
	}
	public function pictures() {
		return $this->hasMany('App\Picture');
	}
	public function sizes() {
		return $this->hasMany('App\Size', 'product_id', 'id');
	}


	public function scopeFetchFromNestedCollections($query, $collectionsIds) {
		$query = $query->orWhere('collection_id', $collectionsIds[0]);
		foreach (array_slice($collectionsIds, 1) as $collectionId) {
			$query = $query->orWhere('collection_id', $collectionId);
		}
		return $query;
	}
}
