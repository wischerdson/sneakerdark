<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collections';
	protected $guarded = [];
	public $timestamps = false;

	public function children() {
		return $this->hasMany('App\Collection', 'parent_id', 'id');
	}

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
}
