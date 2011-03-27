<?php
namespace awesomeircbotweb\models;
use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ChannelUserBean;
use awesomeircbotweb\sqlbeans\ChannelMessageBean;

class UserModel extends Model {
	
	protected static $modelID = "user";
	
	public function getTopUsersByMessageCount($count=false, $time=false) {
		$query = new Query("SELECT");
		$query->where("channel_name = ?", Config::getVal("general", "channel"));
		
		if ($time) {
			if ($time == "week")
				$query->where("time > ?", time()-60*60*24*7);
			else if ($time == "day")
				$query->where("time > ?", time()-60*60*24);
			else if ($time == "hour")
				$query->where("time > ?", time()-60*60);
		}
		
		$messages = ChannelMessageBean::select($query);
		
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
			$query->from("channel_messages");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("nickname = ?", $nick);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "hour") {
			$query = new Query("SELECT");
			$query->from("channel_messages");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60);
			$query->where("nickname = ?", $nick);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "day") {
			$query = new Query("SELECT");
			$query->from("channel_messages");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60*24);
			$query->where("nickname = ?", $nick);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
		else if ($time == "week") {
			$query = new Query("SELECT");
			$query->from("channel_messages");
			$query->field("id");
			$query->where("channel_name = ?", Config::getVal("general", "channel"));
			$query->where("time > ?", time()-60*60*24*7);
			$query->where("nickname = ?", $nick);
			
			$stmt = $query->prepare();
			$stmt->execute();
			
			$i=0;
			while($row = $stmt->fetchObject())
				$i++;
			return $i;
		}
	}
}
?>