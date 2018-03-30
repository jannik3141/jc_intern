<?php
/**
 * Some custom helper functions
 */


/**
 * If $value is in array, remove it, otherwise add it.
 *
 * @param array $array
 * @param $value
 * @param boolean strict
 * @return array
 */
function array_xor_value(array $array, $value, bool $strict = true) {
    $position = array_search($value, $array, $strict);
    if (false === $position) {
        $array[] = $value;
    } else {
        $array = array_except($array, $position);
    }
    return $array;
}


/**
 * LaTeX: $bigger \setMinus $smaller
 *
 * shows the difference between $bigger and $smaller, but ignores everything in $smaller which is not in $bigger
 *
 * @param array $bigger
 * @param array $smaller
 * @return array
 */
function set_minus(array $bigger, array $smaller) {
    return array_diff($bigger, array_intersect($bigger, $smaller));
}

/**
 * Returns the power set of a one dimensional array, a 2-D array.
 * [a,b,c] -> [ [a], [b], [c], [a, b], [a, c], [b, c], [a, b, c] ]
 *
 * @param array $in
 * @param int $minLength
 * @return array
 */
function power_set(array $in, int $minLength = 1) {
    $count = count($in);
    $members = pow(2,$count);
    $return = array();
    for ($i = 0; $i < $members; $i++) {
        $b = sprintf("%0".$count."b",$i);
        $out = array();
        for ($j = 0; $j < $count; $j++) {
            if ($b{$j} == '1') $out[] = $in[$j];
        }
        if (count($out) >= $minLength) {
            $return[] = $out;
        }
    }
    return $return;
}

/**
 * Shorten a string if it is longer than $length. If a string has been shortened, $indicator will be appended.
 *
 * @param String $string
 * @param int $length
 * @param String $indicator
 * @return string
 */
function str_shorten(String $string, int $length, String $indicator = '') {
    $result = mb_substr($string, 0, $length);
    if ($result != $string) {
        $result .= $indicator;
    }
    return $result;
}


/**
 * Compare the given date types to the available ones and return the inverse.
 * If a date type is unknown, it will be dropped.
 *
 * @param array $date_types
 * @return array
 */
function invert_date_types (array $date_types) {
    return set_minus(\App\Http\Controllers\DateController::getDateTypes(), $date_types);
}

/**
 * Compare the given date statuses to the available ones and return the inverse.
 * If a date status is unknown, it will be dropped.
 *
 * @param array $date_statuses
 * @return array
 */
function invert_date_statuses (array $date_statuses) {
    return set_minus(\App\Http\Controllers\DateController::getDateStatuses(), $date_statuses);
}

