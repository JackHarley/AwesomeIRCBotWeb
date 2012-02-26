<?php
/**
 * Index page for AwesomeIRCBotWeb
 * Includes all the library files and dispatches
 * the request to a controller
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", "On");
date_default_timezone_set('UTC');

require_once(__DIR__ . "/lib/hydrogen/hydrogen.inc.php");
require_once(__DIR__ . "/lib/awesomeircbotweb/awesomeircbotweb.inc.php");

use hydrogen\controller\Dispatcher;
use hydrogen\view\View;
use hydrogen\config\Config;
use hydrogen\errorhandler\ErrorHandler;

use awesomeircbotweb\models\UserModel;
use awesomeircbotweb\models\ChannelModel;

ErrorHandler::attachErrorPage();
 
View::setVar("channel", Config::getVal("general", "channel"));
View::setVar("ircAddress", Config::getVal("general", "irc_network_address"));

$um = UserModel::getInstance();
$nick = $um->getLoggedInNick();

if ($nick)
	View::setVar("loggedInUser", $nick);

Dispatcher::addHomeMatchRule("\awesomeircbotweb\controllers\HomeController", "index");
Dispatcher::addPathInfoAutoMapRule("\awesomeircbotweb\controllers", "Controller");
Dispatcher::addMatchAllRule("\awesomeircbotweb\controllers\ErrorController", "notFound");
Dispatcher::dispatch();

?>