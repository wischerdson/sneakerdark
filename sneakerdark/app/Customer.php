<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
	protected $table = 'customers';
	protected $guarded = [];
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function personal_data() {
		return $this->hasOne('App\CustomerPersonalData');
	}
}
