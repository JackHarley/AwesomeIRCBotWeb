<?php
/**
 * Chat Controller
 * Controls the webchat page
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;
use hydrogen\config\Config;

class ChatController extends Controller {
	
	/**
	 * Webchat
	 */
	public function index() {
		View::load('chat', array(
			"address" => Config::getVal('general', 'irc_network_address'),
			"channel" => Config::getVal('general', 'channel'))
		);
	}

}

?>