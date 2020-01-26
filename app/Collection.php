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

	public function descriptions()
	{
		return $this->hasMany('App\CollectionDescription');
	}

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function getChildrenAttribute($id = null, $children = [], $collections = [])
	{
		if (!$id)
			$id = $this->id;

		$collections = empty($collections) ? self::select(['id', 'parent_id'])->get()->toArray() : $collections;
		$children[] = $id;
		foreach ($collections as $collection) {
			if ($collection['parent_id'] == $id) {
				$children = $this->getChildrenAttribute($collection['id'], $children, $collections);
			}
		}

		return $children;
	}

	public function getChainAttribute()
	{
		$result = [$this];
		$parentId = $this->parent_id;
		while ($parentId) {
			$collection = self::find($parentId);
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
