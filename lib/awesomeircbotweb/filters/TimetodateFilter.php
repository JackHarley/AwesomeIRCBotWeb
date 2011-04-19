<?php
/**
 * Time to Date filter
 * Converts a UNIX timestamp into a nice
 * date string using PHP date()
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\filters;

use hydrogen\view\engines\hydrogen\Filter;

class TimetodateFilter implements Filter {

        public static function applyTo($string, $args, &$escape, $phpfile) {
                return "date(" . $args[0]->getValue($phpfile) . ", $string)";
        }
}

?>