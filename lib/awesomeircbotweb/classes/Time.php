<?php
namespace awesomeircbotweb\classes;

class Time {
	
	public $hour;
	public $minute;
	public $second;
	
	public $day;
	public $month;
	public $year;
	
	public $timestamp;
	
	public function makeTimestamp() {
		$this->timestamp = mktime($this->hour, $this->minute, $this->second, $this->month, $this->day, $this->year);
	}
}
?>