<?php
/**
 * User Controller
 * Controls the logins/logouts to the site
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\controllers;

use hydrogen\controller\Controller;
use hydrogen\view\View;
use hydrogen\config\Config;

use awesomeircbotweb\models\UserModel;

class UserController extends Controller {
	
	public function login() {
		$um = UserModel::getInstance();
		
		if ($_POST["submit"]) {
			$r = $um->login($_POST["username"], $_POST["password"]);
			
			if ($r)
				header("Location: " . Config::getVal("general", "app_url") . "/index.php/user/profile");
			else
				View::load('user/login_form', array(
					"alert" => array(
						"type" => "error",
						"message" => "Login failed, username and password do not match!"
					)
				));
		}
		else {
			View::load('user/login_form');
		}
	}
	
	public function profile() {
		$um = UserModel::getInstance();
		
		$nick = $um->getLoggedInNick();
		
		if (!$nick)
			header("Location: " . Config::getVal("general", "app_url") . "/index.php/user/login");
		else
			View::load('user/profile', array(
				"nick" => $nick)
			);
	}
}