<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameters';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function product() {
		return $this->belongsTo('App\Product');
	}
}
