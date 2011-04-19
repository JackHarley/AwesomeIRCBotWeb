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
		foreach ($latestMessages as $id => $message) {
			$split = explode(" ", $message->message);
			
			if (strpos($split[0], "ACTION") !== false) {
				$latestMessages[$id]->message = $message->nickname . str_replace("ACTION", "", $latestMessages[$id]->message);
				$latestMessages[$id]->nickname = " ";
			}
		}
		
		View::load('channel', array(
			"latestMessages" => $latestMessages,
			"latestMessage" => $latestMessages[0])
		);
	}
	
	public function ajax() {
		
		if (!$_POST["timestamp"]) {
			echo "Invalid Request";
			return;
		}
			
		$ChannelModel = ChannelModel::getInstance();
		$time = time();
		while((time() - $time) < 120) {
			$latestMessage = $ChannelModel->getMessagePastTimestamp($_POST["timestamp"]);
			
			if(!empty($latestMessage)) {
				
				$split = explode(" ", $latestMessage->message);
				if (strpos($split[0], "ACTION") !== false) {
					$latestMessage->message = $latestMessage->nickname . str_replace("ACTION", "", $latestMessage->message);
					$latestMessage->nickname = " ";
				}
				
				$data = array(
					"message" => $latestMessage->message,
					"timestamp" => $latestMessage->time,
					"nickname" => $latestMessage->nickname,
					"target_nick" => $latestMessage->target_nick,
					"channel_name" => $latestMessage->channel_name,
					"type" => $latestMessage->type
				);
					
				echo json_encode($data);
				break;
			}
			
			usleep(25000);
		}
	}
}

?>