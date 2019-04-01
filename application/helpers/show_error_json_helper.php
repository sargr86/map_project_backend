<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('show_error_json')) {
    function show_error_json($message, $status_code = 500)
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        header("HTTP/1.1 500 Internal Server Error");

        echo json_encode(
            array(
                'status' => FALSE,
                'error' => 'Internal Server Error',
                'message' => $message
            )
        );

        exit;
    }
}

?>