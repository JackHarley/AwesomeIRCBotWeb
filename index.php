<?php
/**
 * Index page for AwesomeIRCBotWeb
 * Includes all the library files and dispatches
 * the request to a controller
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "On");
date_default_timezone_set('UTC');

require_once(__DIR__ . "/lib/hydrogen/hydrogen.inc.php");
require_once(__DIR__ . "/lib/awesomeircbotweb/awesomeircbotweb.inc.php");

use hydrogen\controller\Dispatcher;
use hydrogen\view\View;
use hydrogen\config\Config;

use awesomeircbotweb\models\ChannelModel;

View::setVar("channel", Config::getVal("general", "channel"));
View::setVar("ircAddress", Config::getVal("general", "irc_network_address"));

$ChannelModel = ChannelModel::getInstance();
$onlineUsers = $ChannelModel->getOnlineUsers();
View::setVar("onlineUsers", $onlineUsers);

Dispatcher::addHomeMatchRule("\awesomeircbotweb\controllers\HomeController", "index");
Dispatcher::addPathInfoAutoMapRule("\awesomeircbotweb\controllers", "Controller");
Dispatcher::addMatchAllRule("\awesomeircbotweb\controllers\ErrorController", "notFound");
Dispatcher::dispatch();

?>