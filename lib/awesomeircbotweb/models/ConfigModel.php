<?php
/**
 * Config Model
 * Contains functions to use for setting and getting
 * config values
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\models;

use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ConfigValueBean;

class ConfigModel extends Model {
	
	protected static $modelID = "moduledata";
	
	public function getValue($key) {
		$q = new Query("SELECT");
		$q->where("key = ?", $key);
		$q->limit(1);
		$q->orderby("id", "DESC");
		
		$cvbs = ConfigValueBean::select($q);
		$cvb = $cvbs[0];
		
		$data = unserialize($cvb->data);

		return $data;
	}
	
	public function setValue($key, $data) {
		$q = new Query("DELETE");
		$q->from("config");
		$q->where("key = ?", $key);
		$stmt = $q->prepare();
		$stmt->execute();
		
		$cvb = new ConfigValueBean;
		$cvb->key = $key;
		$cvb->data = serialize($data);
		$cvb->set("last_updated_time", "NOW()", true);
		$cvb->insert();
	}
}
?>