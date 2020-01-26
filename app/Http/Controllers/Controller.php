<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $template;
	protected $vars = [];
	protected $title = 'Sneakerdark - магазин одежды, обуви и аксессуаров';
	protected $description = '';
	protected $transparentHeader = false;
	protected $ogImage = null;

	protected function output()
	{
		$this->vars['title'] = $this->title;
		$this->vars['description'] = $this->description;
		$this->vars['template'] = $this->template;
		$this->vars['ogImage'] = $this->ogImage ?? asset('/image/social-media-banner.png');
		$this->vars['transparentHeader'] = $this->transparentHeader;

		return view('layout')->with($this->vars);
	}
}
