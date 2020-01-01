<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collections';
	protected $guarded = [];
	public $timestamps = false;

	public function products() {
		return $this->hasMany('App\Product');
	}

	public function getChildrenAttribute($id = null, $children = [], $collections = []) {
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

	/*public function getChildrenAttribute($id = null, $tree = []) {
		if (!$id)
			$id = $this->id;
		array_push($tree, $id);
		foreach (self::where('parent_id', $id)->cursor() as $collection) {
			$tree = $this->getChildrenAttribute($collection->id, $tree);
		}
		return $tree;
	}*/

	public function getChainAttribute() {
		$result = [$this];
		$parentId = $this->parent_id;
		while ($parentId) {
			$collection = self::find($parentId);
			array_push($result, $collection);
			$parentId = $collection->parent_id;
		}

		return array_reverse($result);
	}
}
