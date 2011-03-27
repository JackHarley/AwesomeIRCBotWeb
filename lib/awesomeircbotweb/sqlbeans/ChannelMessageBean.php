<?php
namespace awesomeircbotweb\sqlbeans;
use hydrogen\sqlbeans\SQLBean;

class ChannelMessageBean extends SQLBean {

	protected static $tableNoPrefix = 'channel_messages';
	protected static $tableAlias = 'channel_messages';
	protected static $primaryKey = 'id';
	protected static $primaryKeyIsAutoIncrement = true;
	protected static $fields = array(
		'id',
		'nickname',
		'host',
		'ident',
		'channel_name',
		'message',
		'time'
	);
	
	protected static $beanMap = array(
	);
}
?>