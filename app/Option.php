<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $table = 'option';
	protected $guarded = [];
	public $timestamps = false;
}
