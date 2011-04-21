<?php
/**
 * Stats Controller
 * Controls the stats are which shows
 * channel stats and user stats
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

use awesomeircbotweb\models\ChannelModel;
use awesomeircbotweb\models\UserModel;

class StatsController extends Controller {
	
	/**
	 * Shows overall channel stats
	 */ 
	public function index() {
		
		$ChannelModel = ChannelModel::getInstance();
		
		$ownerCount = $ChannelModel->getOwnerCount();
		$protectedCount = $ChannelModel->getProtectedCount();
		$opCount = $ChannelModel->getOpCount();
		$halfOpCount = $ChannelModel->getHalfOpCount();
		$voicedCount = $ChannelModel->getVoicedCount();
		$totalPrivileged = $ownerCount + $protectedCount + $opCount + $halfOpCount + $voicedCount;
		$unprivilegedCount = $totalUserCount - $totalPrivileged;
		
		$totalUserCount = $ChannelModel->getTotalUsers();
		
		View::load('stats', array(
			"hourMessageCount" => $ChannelModel->getMessageCount("hour"),
			"dayMessageCount" => $ChannelModel->getMessageCount("day"),
			"weekMessageCount" => $ChannelModel->getMessageCount("week"),
			
			"numberOwners" => $ownerCount,
			"numberProtected" => $protectedCount,
			"numberOps" => $opCount,
			"numberHalfOps" => $halfOpCount,
			"numberVoiced" => $voicedCount,
			"numberUnprivileged" => $unprivilegedCount,
			
			"numberUsers" => $totalUserCount)
		);
	}
	
	/**
	 * Shows stats for the given user
	 *
	 * @param string nickname to get stats for
	 */
	public function user($nick) {
		
		$UserModel = UserModel::getInstance();
		$ChannelModel = ChannelModel::getInstance();
		
		if ($UserModel->getOnlineStatus($nick))
			$isOnline = "yes";
		
		View::load("userstats", array(
			"online" => $isOnline,
			"nickname" => $nick,
			
			"hour" => array(
				"messages" => $UserModel->getMessageCount($nick, "hour"),
				"words" => $UserModel->getWordCount($nick, "hour"),
				"wordsPerMessage" => $UserModel->getAverageWordsPerMessage($nick, "hour"),
			),
			
			"day" => array(
				"messages" => $UserModel->getMessageCount($nick, "day"),
				"words" => $UserModel->getWordCount($nick, "day"),
				"wordsPerMessage" => $UserModel->getAverageWordsPerMessage($nick, "day")
			),
			
			"week" => array(
				"messages" => $UserModel->getMessageCount($nick, "week"),
				"words" => $UserModel->getWordCount($nick, "week"),
				"wordsPerMessage" => $UserModel->getAverageWordsPerMessage($nick, "week")
			),
			
			"latestUserMessages" => $ChannelModel->getLatestMessages(10, $nick))
		);
	}
}

?>