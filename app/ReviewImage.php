<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    protected $table = 'review_image';
	protected $guarded = [];
	public $timestamps = false;

	public function review() {
		return $this->belongsTo('App\Review');
	}
}
