<?php
/**
 * Round filter
 * Rounds a float/double to the precision
 * given
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbotweb\filters;

use hydrogen\view\engines\hydrogen\Filter;

class RoundFilter implements Filter {

        public static function applyTo($string, $args, &$escape, $phpfile) {
                return "round(" . $string . ", " . $args[0]->getValue($phpfile) . ") ";
        }
}

?>