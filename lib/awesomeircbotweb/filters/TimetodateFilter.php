<?php
namespace awesomeircbotweb\filters;

use hydrogen\view\engines\hydrogen\Filter;

class TimetodateFilter implements Filter {

        public static function applyTo($string, $args, &$escape, $phpfile) {
                return "date(" . $args[0]->getValue($phpfile) . ", $string)";
        }
}

?>