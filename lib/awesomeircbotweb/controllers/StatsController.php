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
	
	public function index() {
		
		$ChannelModel = ChannelModel::getInstance();
		$hourMessages = $ChannelModel->getMessageCount("hour");
		$dayMessages = $ChannelModel->getMessageCount("day");
		$weekMessages = $ChannelModel->getMessageCount("week");
		
		$totalUserCount = $ChannelModel->getTotalUsers();
		$ownerCount = $ChannelModel->getOwnerCount();
		$protectedCount = $ChannelModel->getProtectedCount();
		$opCount = $ChannelModel->getOpCount();
		$halfOpCount = $ChannelModel->getHalfOpCount();
		$voicedCount = $ChannelModel->getVoicedCount();
		$totalPrivileged = $ownerCount + $protectedCount + $opCount + $halfOpCount + $voicedCount;
		$unprivilegedCount = $totalUserCount - $totalPrivileged;

		View::load('stats', array(
			"hourMessageCount" => $hourMessages,
			"dayMessageCount" => $dayMessages,
			"numberOwners" => $ownerCount,
			"numberProtected" => $protectedCount,
			"numberOps" => $opCount,
			"numberHalfOps" => $halfOpCount,
			"numberVoiced" => $voicedCount,
			"numberUnprivileged" => $unprivilegedCount,
			"numberUsers" => $totalUserCount)
		);
	}
	
	public function user($nick) {
		
		$UserModel = UserModel::getInstance();
		$ChannelModel = ChannelModel::getInstance();
		
		if ($UserModel->getOnlineStatus($nick))
			$isOnline = "yes";
		
		$hourMessages = $UserModel->getMessageCount($nick, "hour");
		$dayMessages = $UserModel->getMessageCount($nick, "day");
		$weekMessages = $UserModel->getMessageCount($nick, "week");
		$latestUserMessages = $ChannelModel->getLatestMessages(10, $nick);
		$hourWords = $UserModel->getWordCount($nick, "hour");
		$dayWords = $UserModel->getWordCount($nick, "day");
		$weekWords = $UserModel->getWordCount($nick, "week");
		
		View::load("userstats", array(
			"online" => $isOnline,
			"nickname" => $nick,
			"hourMessages" => $hourMessages,
			"dayMessages" => $dayMessages,
			"weekMessages" => $weekMessages,
			"latestUserMessages" => $latestUserMessages,
			"hourWords" => $hourWords,
			"dayWords" => $dayWords,
			"weekWords" => $weekWords)
		);
	}
}

?>