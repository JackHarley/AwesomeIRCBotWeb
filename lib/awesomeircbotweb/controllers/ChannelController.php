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
			"latestMessages" => $latestMessages,
			"latestMessage" => $latestMessages[0])
		);
	}
	
	public function ajax() {
		
		$ChannelModel = ChannelModel::getInstance();
		$time = time();
		while((time() - $time) < 30) {
			$latestMessage = $ChannelModel->getMessagePastTimestamp($_POST["timestamp"]);
			
			if(!empty($latestMessage)) {
				$nickname = $latestMessage->nickname;
				$message = $latestMessage->message;
				$timestamp = $latestMessage->time;
				
				$data = array("message" => $message,
							  "timestamp" => $timestamp,
							  "nickname" => $nickname);
				
				echo json_encode($data);
				break;
			}
			
			usleep(25000);
		}
	}
}

?>