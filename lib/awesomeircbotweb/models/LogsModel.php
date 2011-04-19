<?php
/**
 * Logs Model
 * Contains functions to get logs of actions
 * which occured
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\models;
use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ChannelActionBean;

class LogsModel extends Model {
	
	protected static $modelID = "user";
	
	public function getLogsByTime($startTimeObj, $endTimeObj) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		
		$startTimeObj->makeTimestamp();
		$endTimeObj->makeTimestamp();
		
		$query->where("time > ?", $startTimeObj->timestamp);
		$query->where("time < ?", $endTimeObj->timestamp, "AND");
		
		$messagesArray = ChannelActionBean::select($query);
		return $messagesArray;
	}
}
?>