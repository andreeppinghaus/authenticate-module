<?php 

spl_autoload_register( function($name) {

	$name = str_replace('\\','/' ,$name);
	// echo __DIR__.'/'.$name.'.php \n';
	// die();

	if (is_file(__DIR__.'/'.$name.'.php')) {
	    require_once(__DIR__.'/'.$name.'.php');
    }
    
});
