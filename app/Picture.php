<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	protected $table = 'pictures';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
