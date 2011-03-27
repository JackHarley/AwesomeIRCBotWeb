<?php
/**
 * Leaderboard Controller
 * Controls the leaderboards
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;

use awesomeircbotweb\models\UserModel;

class LeaderboardController extends Controller {
	
	public function index() {
		$UserModel = UserModel::getInstance();
		$leaderboardPastWeekArray = $UserModel->getTopUsersByMessageCount(50, "week");
		$leaderboardPastDayArray = $UserModel->getTopUsersByMessageCount(50, "day");
		
		View::load("leaderboard", array(
			"leaderboardWeekEntries" => $leaderboardPastWeekArray,
			"leaderboardDayEntries" => $leaderboardPastDayArray)
		);
	}

}

?>