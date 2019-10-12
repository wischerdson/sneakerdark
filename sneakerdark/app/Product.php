<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function category() {
		return $this->belongsTo('App\Category', 'category_id', 'bizoutmax_id');
	}
	public function parameters() {
		return $this->hasMany('App\Parameter');
	}
	public function pictures() {
		return $this->hasMany('App\Picture');
	}
	public function sizes() {
		return $this->hasMany('App\Size', 'product_id', 'article');
	}
}
