<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Collection extends Model
{
	use Sluggable;

	protected $table = 'collection';
	protected $guarded = [];
	public $timestamps = false;

	public function description()
	{
		return $this->hasOne('App\CollectionDescription');
	}

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function scopeFindByAlias($query, $alias)
	{
		$result = $query->where('alias', $alias)->first();
		if (is_null($result))
			abort(404);

		return $result;
	}

	public function getChildrenAttribute($supplierId = null, $id = null, $children = [], $allCollections = [])
	{
		$supplierId = is_null($supplierId) ? $this->supplier_id : $supplierId;
		$id = is_null($id) ? $this->id : $id;

		$allCollections = empty($allCollections) ? self::select(['id', 'supplier_id', 'parent_id'])->get()->toArray() : $allCollections;
		$children[] = $id;
		foreach ($allCollections as $collection) {
			if ($collection['parent_id'] == $supplierId) {
				$children = $this->getChildrenAttribute($collection['supplier_id'], $collection['id'], $children, $allCollections);
			}
		}

		return $children;
	}

	public function getChainAttribute()
	{
		$result = [$this];
		$parentId = $this->parent_id;
		while (!is_null($parentId)) {
			$collection = self::where('supplier_id', $parentId)->with('description')->first();
			array_push($result, $collection);
			$parentId = $collection->parent_id;
		}

		return array_reverse($result);
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
		parent::updating(function($model) {
			$model->updated_at = time();
		});
	}
}
