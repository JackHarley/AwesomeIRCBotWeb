<?php
/**
 * Home Controller
 * Controls the site homepage
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

class HomeController extends Controller {
	
	public function index() {
		View::load('index');
	}

}

?>