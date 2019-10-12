<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function products() {
		return $this->hasMany('App\Product');
	}
}
