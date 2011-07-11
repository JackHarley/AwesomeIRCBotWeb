<?php
/**
 * Channel SQLBean
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ChannelBean extends SQLBean {

	protected static $tableNoPrefix = 'channels';
	protected static $tableAlias = 'channels';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'name',
		'topic',
		'modes'
	);
	
	protected static $beanMap = array(
	);
}
?>