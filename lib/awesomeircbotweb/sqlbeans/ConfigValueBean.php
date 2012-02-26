<?php
/**
 * Config Value SQLBean
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ConfigValueBean extends SQLBean {

	protected static $tableNoPrefix = 'config';
	protected static $tableAlias = 'config';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'key',
		'data',
		'last_updated_time'
	);
	
	protected static $beanMap = array(
	);
}
?>