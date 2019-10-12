<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPersonalData extends Model
{
    protected $table = 'customers_personal_data';
	protected $guarded = [];
	protected $primaryKey = 'customer_id';
	public $timestamps = false;

	public function customer() {
		return $this->belongsTo('App\Customer');
	}
}
