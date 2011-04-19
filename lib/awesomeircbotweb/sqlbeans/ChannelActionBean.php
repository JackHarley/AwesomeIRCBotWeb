<?php
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ChannelActionBean extends SQLBean {

	protected static $tableNoPrefix = 'channel_actions';
	protected static $tableAlias = 'channel_actions';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'type',
		'nickname',
		'host',
		'ident',
		'channel_name',
		'message',
		'target_nick',
		'time'
	);
	
	protected static $beanMap = array(
	);
}
?>