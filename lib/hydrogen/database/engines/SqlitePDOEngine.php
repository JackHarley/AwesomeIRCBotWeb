<?php
/*
 * Copyright (c) 2009 - 2011, Frosted Design
 * All rights reserved.
 */

namespace hydrogen\database\engines;

use hydrogen\database\engines\PDOEngine;
use hydrogen\database\statements\GenericPDOStatement;

class SqlitePDOEngine extends PDOEngine {
	
	public function setConnection($host, $port, $socket, $database, $username, $password, $tablePrefix) {
		if ($socket)
			parent::setPDOConnection($host, $port, $socket, $database, $username, $password,
				"sqlite:$database");
		else
			parent::setPDOConnection($host, $port, $socket, $database, $username, $password,
				"sqlite:$database");
	}
}

?>