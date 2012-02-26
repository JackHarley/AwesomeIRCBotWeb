<?php
/**
 * Module Data SQLBean
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ModuleDataBean extends SQLBean {

	protected static $tableNoPrefix = 'module_data';
	protected static $tableAlias = 'module_data';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'title',
		'module',
		'data',
		'last_updated_time'
	);
	
	protected static $beanMap = array(
	);
}
?>