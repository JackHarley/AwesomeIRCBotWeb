<?php
/**
 * Error Controller
 * Controls site errors
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

class ErrorController extends Controller {
	
	/**
	 * 404 Not Found Error Page
	 */
	public function notFound() {
		View::load('404');
	}

}

?>