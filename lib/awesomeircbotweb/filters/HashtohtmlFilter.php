<?php
namespace awesomeircbotweb\filters;

use hydrogen\view\engines\hydrogen\Filter;

class HashtohtmlFilter implements Filter {

        public static function applyTo($string, $args, &$escape, $phpfile) {
                return "str_replace('#', '%23', {$string})";
        }
}

?>