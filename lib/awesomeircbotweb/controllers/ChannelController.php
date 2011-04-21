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
	
	/**
	 * Channel Right Now Page
	 */
	public function index() {
		
		$ChannelModel = ChannelModel::getInstance();
		$latestMessages = $ChannelModel->getLatestMessages(75);
		foreach ($latestMessages as $id => $message) {
			$split = explode(" ", $message->message);
			
			if (strpos($split[0], "ACTION") !== false) {
				$latestMessages[$id]->message = $message->nickname . str_replace("ACTION", "", $latestMessages[$id]->message);
				$latestMessages[$id]->nickname = " ";
			}
		}
		
		View::load('channel', array(
			"latestMessages" => $latestMessages,
			"latestMessage" => $latestMessages[0],
			"oldestMessage" => $latestMessages[49])
		);
	}
	
	/**
	 * AJAX request for the next new message
	 * after the given timestamp
	 *
	 * @param post-int unix epoch timestamp
	 * @return json message, timestamp, nickname, target_nick,
	 * channel_name, type
	 */
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
					"message" => htmlentities($latestMessage->message),
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
	
	/**
	 * AJAX request for 50 messages before
	 * the given timestamp
	 *
	 * @param post-int unix epoch timestamp
	 * @return json array of objects with message, timestamp,
	 * nickname, target_nick, channel_name, type
	 */
	public function ajaxolder() {
		
		if (!$_POST["timestamp"]) {
			echo "Invalid Request";
			return;
		}
			
		$ChannelModel = ChannelModel::getInstance();
		$olderMessages = $ChannelModel->getMessagesBeforeTimestamp($_POST["timestamp"], 50);
		$returnData = array();
		
		foreach($olderMessages as $olderMessage) {
			$split = explode(" ", $olderMessage->message);
			if (strpos($split[0], "ACTION") !== false) {
				$olderMessage->message = $olderMessage->nickname . str_replace("ACTION", "", $olderMessage->message);
				$olderMessage->nickname = " ";
			}
		
			$data = array(
				"message" => htmlentities($olderMessage->message),
				"timestamp" => $olderMessage->time,
				"nickname" => $olderMessage->nickname,
				"target_nick" => $olderMessage->target_nick,
				"channel_name" => $olderMessage->channel_name,
				"type" => $olderMessage->type
			);
			$returnData[] = $data;
		}
			
		echo json_encode($returnData);
	}
}

?>