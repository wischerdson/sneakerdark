<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collection';
	protected $guarded = [];
	protected $timestamps = false;

	public function descriptions() {
		return $this->hasMany('App\CollectionDescription');
	}
}
