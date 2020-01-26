<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function show() {
    	$this->template = 'legal.refund';
		$this->title = 'Обмен и возврат - Sneakerdark';
		return $this->output();
    }
}
