<?php

/**
 * Plugin Name: WordPress Exception Handler
 * Description: Exception Handler for Wordpress
 * Version: 0.0.1
 * Author: Mohan Raj <pream1990@gmail.com>
 */

function wp_eh_error_catch_error()
{
    set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line) {
        new ErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
    });

    set_exception_handler(function ($th) {
        if (isset($_REQUEST['action'])) {
            wp_send_json_error(array(
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace()
            ), 500);

            die;
        }

        echo '<br> ';
        echo esc_html($th->getMessage());
        echo '<br> ';
        echo '<br> ';
        echo esc_html($th->getLine() . ' on ' . $th->getFile());
        echo '<br> ';
        echo '<br> ';
        echo esc_html($th->getTraceAsString());

        die;
    });
}

add_action('admin_init', 'wp_eh_error_catch_error');
