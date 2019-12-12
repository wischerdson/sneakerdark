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

	public function getChildrenAttribute($id = null, $tree = []) {
		if (!$id)
			$id = $this->id;
		array_push($tree, $id);
		foreach (self::where('parent_id', $id)->cursor() as $collection) {
			$tree = $this->getChildrenAttribute($collection->id, $tree);
		}

		return $tree;
	}
}
