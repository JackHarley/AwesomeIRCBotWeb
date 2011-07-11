<?php
/**
 * Channel Model
 * Contains functions to use for getting
 * information about a channel
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
use awesomeircbotweb\sqlbeans\ChannelBean;

use awesomeircbotweb\classes\ReceivedLineTypes;

class ChannelModel extends Model {
	
	protected static $modelID = "channel";
	
	/**
	 * Gets all the currently online users on the
	 * channel and returns them as an array, sorted by
	 * privileges
	 *
	 * @return array online users sorted by privileges
	 */
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
	
	/**
	 * Gets the latest messages sent to the channel
	 * and returns them as an array, latest messages first
	 *
	 * @param integer $count number of messages to get
	 * @param string $nick optionally, specify a nick and only
	 * get messages sent by that user
	 * @return array of ChannelActionBean objects
	 */
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
	
	/**
	 * Get the total number of messages sent in
	 * a period of time, or since records began
	 *
	 * @param string $time optionally, specify either
	 * "hour", "day" or "week" to get the number of messages
	 * sent in that time period
	 * @return integer number of messages
	 */
	public function getMessageCount($time=false) {
		$query = new Query("SELECT");
		$query->from("channel_actions");
		$query->field("id");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("type = ?", ReceivedLineTypes::CHANMSG);
		
		if ($time == "hour") {
			$query->where("time > ?", time()-60*60);
		}
		else if ($time == "day") {
			$query->where("time > ?", time()-60*60*24);
		}
		else if ($time == "week") {
			$query->where("time > ?", time()-60*60*24*7);
		}
		
		$stmt = $query->prepare();
		$stmt->execute();
		
		$i=0;
		while($row = $stmt->fetchObject())
			$i++;
		return $i;
	}
	
	/**
	 * Gets the topic for the channel
	 *
	 * @return string topic
	 */
	public function getTopic() {
		$query = new Query("SELECT");
		$query->where("name = ?", Config::getVal("general", "channel"));
		$query->limit(1);
		
		$channels = ChannelBean::select($query);
		$channel = $channels[0];
		
		return $channel->topic;
	}
	
	/**
	 * Get the number of owners (~)
	 * connected to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Get the number of protected users (&)
	 * connected to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Get the number of operators (@)
	 * connected to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Get the number of half operators (%)
	 * connected to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Get the number of voiced users (+)
	 * connected to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Get the total number of users connected
	 * to the channel
	 *
	 * @return integer number of users
	 */
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
	
	/**
	 * Gets the message immediately past the given
	 * timestamp
	 *
	 * @param integer $timestamp unix epoch timestamp
	 * @return object ChannelActionBean object
	 */
	public function getMessagePastTimestamp($timestamp) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("time > ?", $timestamp);
		$query->orderby("time", "ASC");
		$query->limit(1);
		
		$messages = ChannelActionBean::select($query);
		return $messages[0];
	}
	
	/**
	 * Gets the message immediately before the given
	 * timestamp
	 *
	 * @param integer $timestamp unix epoch timestamp
	 * @return object ChannelActionBean object
	 */
	public function getMessageBeforeTimestamp($timestamp) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("time < ?", $timestamp);
		$query->orderby("time", "DESC");
		$query->limit(1);
		
		$messages = ChannelActionBean::select($query);
		return $messages[0];
	}
	
	/**
	 * Gets the number of messages specified in $count
	 * that are immediately before the given timestamp
	 *
	 * @param integer $timestamp unix epoch timestamp
	 * @param integer $count number of messages to get
	 * @return array array of ChannelActionBean objects latest
	 * first
	 */
	public function getMessagesBeforeTimestamp($timestamp, $count) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		$query->where("time < ?", $timestamp);
		$query->orderby("time", "DESC");
		$query->limit($count);
		
		$messages = ChannelActionBean::select($query);
		return $messages;
	}
}