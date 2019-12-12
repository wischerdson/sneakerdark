<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use Response;

use App\Collection;

class SiteController extends Controller
{
	protected $template;
	protected $vars = [];
	protected $title = 'Sneakerdark';
	protected $description = '';
	protected $transparentHeader = false;


	protected function output() {
		$this->vars['title'] = $this->title;
		$this->vars['description'] = $this->description;
		$this->vars['template'] = $this->template;


		//$this->vars['accessories_category'] = Collection::where('parent_id', 3)->orderBy('name')->get();
		$this->vars['transparentHeader'] = $this->transparentHeader;


		return view('layout')->with($this->vars);
	}
}
