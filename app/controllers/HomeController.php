<?php

class HomeController extends BaseController {

	protected $layout = 'front.master';
	
	public function __construct() {
		parent::__construct();
	}
	

	public function showHome()
	{
		$data['data'] = array();
		$this->layout->content = View::make('front.home', $data);
	}

	public function showQuery($query)
	{
		return 'chuj';
	}

}
