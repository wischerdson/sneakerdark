<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionDescription extends Model
{
    protected $table = 'collection_description';
	protected $guarded = [];
	public $timestamps = false;

	public function collection() {
		return $this->belongsTo('App\Collection');
	}
}
