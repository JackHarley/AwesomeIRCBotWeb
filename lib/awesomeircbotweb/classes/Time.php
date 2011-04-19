<?php
/**
 * Time class
 * Contains a time
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\classes;

class Time {
	
	public $hour;
	public $minute;
	public $second;
	
	public $day;
	public $month;
	public $year;
	
	public $timestamp;
	
	/**
	 * Creates a timestamp from the information
	 * in the object's properties
	 */
	public function makeTimestamp() {
		$this->timestamp = mktime($this->hour, $this->minute, $this->second, $this->month, $this->day, $this->year);
	}
}
?>