<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collections';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function products() {
		return $this->hasMany('App\Product');
	}
}
