<?php
/**
 * Channel Controller
 * Controls the "channel right now area"
 * which shows the latest chat messages and
 * user list
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

use awesomeircbotweb\models\ChannelModel;

class ChannelController extends Controller {
	
	public function index() {
		
		$ChannelModel = ChannelModel::getInstance();
		$latestMessages = $ChannelModel->getLatestMessages(50);
		
		View::load('channel', array(
			"latestMessages" => $latestMessages)
		);
	}
}

?>