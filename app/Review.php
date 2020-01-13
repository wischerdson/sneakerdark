<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
	protected $guarded = [];
	protected $timestamps = false;

	public function images() {
		return $this->hasMany('App\ReviewImage');
	}
}
