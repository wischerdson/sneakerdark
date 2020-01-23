<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Collection extends Model
{
	use Sluggable;

	protected $table = 'collection';
	protected $guarded = [];
	public $timestamps = false;

	public function descriptions() {
		return $this->hasMany('App\CollectionDescription');
	}

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'alias' => [
				'source' => ''
			]
		];
	}

	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->created_at = time();
			$model->updated_at = time();
		});
		parent::updating(function($model) {
			$model->updated_at = time();
		});
	}
}
