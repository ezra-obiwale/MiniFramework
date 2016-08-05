<?php
/**
 * User: Ezra Obiwale
 * Date: 22-Jan-16
 * Time: 23:06
 */
 
 return array(
	'server' => 'development',
	'db' => array(
		'development' => array(
		),
		'production' => array(
		),
	),
	'defaults' => array(
		'module' => 'Guest', // The default module if none is indicated
		'controller' => 'Page', // The default controller if none is indicated
		'action' => 'home' // The default action if none is indicated
	),
	'autoloadDirectories' => array(
		/* [optional] directories from which to autoload classes */
		/* ROOT . 'public' . DIRECTORY_SEPARATOR, // only indicates the path as a classes source */
		/* 'PUBLIC_DIR' => ROOT . 'public' . DIRECTORY_SEPARATOR, // also creates a constant PUBLIC_DIR for the path */
	)
 );