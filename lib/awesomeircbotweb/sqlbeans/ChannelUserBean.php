<?php
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ChannelUserBean extends SQLBean {

	protected static $tableNoPrefix = 'channel_users';
	protected static $tableAlias = 'channel_users';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'nickname',
		'channel_name',
		'privilege'
	);
	
	protected static $beanMap = array(
	);
}
?>