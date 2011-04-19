<?php
namespace awesomeircbotweb\models;
use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ChannelUserBean;
use awesomeircbotweb\sqlbeans\ChannelActionBean;

use awesomeircbotweb\classes\ReceivedLineTypes;

class ChannelModel extends Model {
	
	protected static $modelID = "channel";
	
	public function getOnlineUsers() {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$users = ChannelUserBean::select($query);
		
		$orderedUsers = array();
		
		foreach($users as $user) {
			if ($user->privilege == "~")
				$orderedUsers[] = $user;
		}
		
		foreach($users as $user) {
			if ($user->privilege == "&")
				$orderedUsers[] = $user;
		}
		
		foreach($users as $user) {
			if ($user->privilege == "@")
				$orderedUsers[] = $user;
		}
		
		foreach($users as $user) {
			if ($user->privilege == "%")
				$orderedUsers[] = $user;
		}
		
		foreach($users as $user) {
			if ($user->privilege == "+")
				$orderedUsers[] = $user;
		}
		
		foreach($users as $user) {
			if ($user->privilege == "")
				$orderedUsers[] = $user;
		}
		
		return $orderedUsers;
	}
	
	public function getLatestMessages($count, $nick=false) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->orderby("time", "DESC");
		$query->limit($count);
		
		if ($nick)
			$query->where("nickname = ?", $nick);
		
		$messages = ChannelActionBean::select($query);
		return $messages;
	}
	
	public function getMessageCount($time=false) {
		if (!$time) {
			$query = new Query("SELECT");
			$query->from("channel_actions");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
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
			$query->where("type = ?", ReceivedLineTypes::CHANMSG);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
	}
	
	public function getOwnerCount() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("privilege='~'");
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getProtectedCount() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("privilege='&'");
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getOpCount() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("privilege='@'");
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getHalfOpCount() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("privilege='%'");
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getVoicedCount() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("privilege='+'");
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getTotalUsers() {
		$query = new Query("SELECT");
		$query->from("channel_users");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	public function getMessagePastTimestamp($timestamp) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("time > ?", $timestamp);
		$query->orderby("time", "ASC");
		$query->limit(1);
		
		$messages = ChannelActionBean::select($query);
		return $messages[0];
	}
}