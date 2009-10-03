<?php defined('SYSPATH') or die('No direct script access.');

// Catch-all route for unittest
Route::set('unittest', 'unittest(/<test_dir>)', array('test_dir' => '.*'))
	->defaults(array(
		'controller' => 'unittest',
		'action' => 'index',
		'test_dir' => NULL));
