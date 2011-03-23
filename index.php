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

require_once(__DIR__ . "/lib/hydrogen/hydrogen.inc.php");
require_once(__DIR__ . "/lib/awesomeircbotweb/awesomeircbotweb.inc.php");

use hydrogen\controller\Dispatcher;

Dispatcher::addHomeMatchRule("\awesomeircbotweb\controllers\HomeController", "index");
Dispatcher::addPathInfoAutoMapRule("\awesomeircbotweb\controllers", "Controller");
Dispatcher::addMatchAllRule("\awesomeircbotweb\controllers\ErrorController", "notFound");
Dispatcher::dispatch();

?>