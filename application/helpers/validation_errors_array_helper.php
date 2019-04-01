<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('validation_errors_array')) {

    function validation_errors_array($prefix = '', $suffix = '') {
        if (FALSE === ($OBJ = & _get_validation_object())) {
            return '';
        }

        return $OBJ->error_array($prefix, $suffix);
    }
}