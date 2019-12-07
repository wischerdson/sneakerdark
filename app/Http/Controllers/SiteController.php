<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use Response;

use App\Category;

class SiteController extends Controller
{
	protected $template;
	protected $vars = [];
	protected $title = 'Sneakerdark';
	protected $description = '';
	protected $transparentHeader = false;

	protected $links = [];
	protected $link;

	protected $scripts = [];
	protected $script;

	protected $styles = [];
	protected $style;



	public function __construct() {
		
	}

	protected function output() {
		$this->vars['title'] = $this->title;
		$this->vars['description'] = $this->description;
		$this->vars['template'] = $this->template;


		$this->vars['accessories_category'] = Category::where('parent_id', 3)->orderBy('name')->get();
		$this->vars['transparentHeader'] = $this->transparentHeader;


		return view('layout')->with($this->vars);
	}
}
