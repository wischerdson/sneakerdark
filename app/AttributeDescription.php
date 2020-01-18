<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeDescription extends Model
{
	protected $table = 'attribute_description';
	protected $guarded = [];
	public $timestamps = false;

	public function attribute() {
		return $this->belongsTo('App\Attribute');
	}
}
