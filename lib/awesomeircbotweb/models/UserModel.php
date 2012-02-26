<?php
/**
 * User Model
 * Gets information about users
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\models;
use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ChannelUserBean;
use awesomeircbotweb\sqlbeans\ChannelActionBean;

use awesomeircbotweb\classes\ReceivedLineTypes;

class UserModel extends Model {
	
	protected static $modelID = "user";
	
	public function getTopUsersByMessageCount($count=false, $time=false) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("type = ?", ReceivedLineTypes::CHANMSG);
		
		if ($time) {
			if ($time == "week")
				$query->where("time > ?", time()-60*60*24*7);
			else if ($time == "day")
				$query->where("time > ?", time()-60*60*24);
			else if ($time == "hour")
				$query->where("time > ?", time()-60*60);
		}
		
		$messages = ChannelActionBean::select($query);
		
		$leaderboards = array();
		foreach($messages as $message) {
			$leaderboards[$message->nickname]++;
		}
		
		$highestNick = "None";
		
		$finalLeaderboards = array();
		$position = 1;
		while(count($leaderboards)) {
			foreach($leaderboards as $nickname => $messages) {
				if ($messages > $highestMessageCount) {
					$highestNick = $nickname;
					$highestMessageCount = $messages;
				}
			}
			$finalLeaderboards[] = array("nickname" => $highestNick,
										 "messageCount" => $highestMessageCount,
										 "position" => $position);
			$position++;
			unset($leaderboards[$highestNick]);
			unset($highestMessageCount);
		}
		
		if (!$count)
			return $finalLeaderboards;
		
		$lastIndex = $count - 1;
		foreach ($finalLeaderboards as $index => $data) {
			if ($index > $lastIndex)
				unset($finalLeaderboards[$index]);
		}
		return $finalLeaderboards;
		
		
	}
	
	public function getOnlineStatus($nick) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("nickname = ?", $nick);
		$channelUserBeanSet = ChannelUserBean::select($query);
		$channelUserBean = $channelUserBeanSet[0];
		
		if ($channelUserBean)
			return true;
		else
			return false;
	}
	
	public function getMessageCount($nick, $time=false) {
		if (!$time) {
			$query = new Query("SELECT");
			$query->from("channel_actions");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("nickname = ?", $nick);
			$query->where("type = ?", ReceivedLineTypes::CHANMSG);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "hour") {
			$query = new Query("SELECT");
			$query->from("channel_actions");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60);
			$query->where("nickname = ?", $nick);
			$query->where("type = ?", ReceivedLineTypes::CHANMSG);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "day") {
			$query = new Query("SELECT");
			$query->from("channel_actions");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60*24);
			$query->where("nickname = ?", $nick);
			$query->where("type = ?", ReceivedLineTypes::CHANMSG);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "week") {
			$query = new Query("SELECT");
			$query->from("channel_actions");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60*24*7);
			$query->where("nickname = ?", $nick);
			$query->where("type = ?", ReceivedLineTypes::CHANMSG);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
	}
	
	public function getWordCount($nick, $time=false) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("nickname = ?", $nick);
		$query->where("type = ?", ReceivedLineTypes::CHANMSG);
		
		if ($time == "hour")
			$query->where("time > ?", time()-60*60);
		else if ($time == "day")
			$query->where("time > ?", time()-60*60*24);
		else if ($time == "week")
			$query->where("time > ?", time()-60*60*24*7);
		
		$messages = ChannelActionBean::select($query);
		$wordCount = 0;
		
		foreach($messages as $message) {
			$words = str_word_count($message->message);
			$wordCount += $words;
		}
		
		return $wordCount;
	}
	
	public function getAverageWordsPerMessage($nick, $time=false) {
		$words = $this->getWordCount($nick, $time);
		$messages = $this->getMessageCount($nick, $time);
		
		if ($messages < 1)
			return 0;
		
		return $words / $messages;
	}
	
	public function login($user, $pass) {
		$cm = ConfigModel::getInstance();
		$passwords = $cm->getValue("userPasswords");
		if ($passwords[$user] == md5($pass)) {
			$_SESSION["user"] = $user;
			return true;
		}
		else {
			return false;
		}
	}
	
	public function logout() {
		unset($_SESSION["user"]);
	}
	
	public function getPermissionLevel() {
		$cm = ConfigModel::getInstance();
		$levels = $cm->getValue("users");
		return $levels[$_SESSION["user"]];
	}
	
	public function getLoggedInNick() {
		return($_SESSION["user"]);
	}
		
}
?>