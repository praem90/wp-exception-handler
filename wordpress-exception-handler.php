<?php

/**
 * Plugin Name: WordPress Exception Handler
 * Description: Exception Handler for WordPress
 * Version: 0.0.1
 * Author: Mohan Raj <pream1990@gmail.com>
 */

require_once __DIR__ . '/vendor/autoload.php';

function wp_eh_error_catch_error()
{
    $whoops = new \Whoops\Run();

	if (defined('DOING_AJAX') && DOING_AJAX) {
    	$whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
	} else {
    	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
	}

    $whoops->register();

    return;
}

wp_eh_error_catch_error();
