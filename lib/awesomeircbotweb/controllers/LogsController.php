<?php
/**
 * Logs Controller
 * Controls the log browsing area
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

use awesomeircbotweb\classes\Time;
use awesomeircbotweb\models\LogsModel;

class LogsController extends Controller {
	
	public function index() {
		
		if (!$_POST["submit"]) {
			View::load('logs/form');
			return;
		}
		
		if ($_POST["startday"]) {
			$startTime = new Time;
			$startTime->day = $_POST["startday"];
			$startTime->month = $_POST["startmonth"];
			$startTime->year = $_POST["startyear"];
			$startTime->hour = $_POST["starthour"];
			$startTime->minute = $_POST["startminute"];
			$startTime->second = $_POST["startsecond"];
			
			$endTime = new Time;
			$endTime->day = $_POST["endday"];
			$endTime->month = $_POST["endmonth"];
			$endTime->year = $_POST["endyear"];
			$endTime->hour = $_POST["endhour"];
			$endTime->minute = $_POST["endminute"];
			$endTime->second = $_POST["endsecond"];
			
			$LogsModel = LogsModel::getInstance();
			$messages = $LogsModel->getLogsByTime($startTime, $endTime);
			
			if ($_POST["plain"]) {
				View::load('logs/messages', array(
					"messages" => $messages)
				);
			}
			else {
				$startTime->makeTimestamp();
				$endTime->makeTimestamp();
				
				View::load('logs/messages_formatted', array(
					"messages" => $messages,
					"startTime" => $startTime->timestamp,
					"endTime" => $endTime->timestamp)
				);
			}
		}
			
	}

}

?>