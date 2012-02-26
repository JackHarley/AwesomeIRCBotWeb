<?php
/**
 * Module Data Model
 * Contains functions to use for getting
 * data from the db regarding modules
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */
namespace awesomeircbotweb\models;

use hydrogen\model\Model;

use hydrogen\database\Query;
use hydrogen\config\Config;

use awesomeircbotweb\sqlbeans\ModuleDataBean;

class ModuleDataModel extends Model {
	
	protected static $modelID = "moduledata";
	
	public function retrieve($key, $moduleNamespace) {
		$moduleNamespace = str_replace("\\", "*", $moduleNamespace);
		
		$q = new Query("SELECT");
		$q->where("module = ?", $moduleNamespace);
		$q->where("title = ?", $key);
		$q->limit(1);
		$q->orderby("id", "DESC");
		
		$mdbs = ModuleDataBean::select($q);
		$mdb = $mdbs[0];
		
		$data = unserialize($mdb->data);
		
		return $data;
	}
	
	public function store($key, $data, $moduleNamespace) {
		$moduleNamespace = str_replace("\\", "*", $moduleNamespace);
		
		$q = new Query("DELETE");
		$q->from("module_data");
		$q->where("title = ?", $key);
		$q->where("module = ?", $moduleNamespace);
		$stmt = $q->prepare();
		$stmt->execute();
		
		$mdb = new ModuleDataBean;
		$mdb->title = $key;
		$mdb->data = serialize($data);
		$mdb->module = $moduleNamespace;
		$mdb->set("last_updated_time", "NOW()", true);
		$mdb->insert();
	}
}
?>