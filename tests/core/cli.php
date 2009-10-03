<?php defined('SYSPATH') or die('No direct script access.');

class UnitTest_CLI extends UnitTest_Case {

	protected $_server;

	public function __construct()
	{
		$this->_server = $_SERVER;

		// The filename must always be the first option in argv
		$_SERVER['argv'] = array('index.php', '--unittest', '--test=foo', '--other=bar');
		$_SERVER['argc'] = count($_SERVER['argv']);
	}

	public function __destruct()
	{
		$_SERVER = $this->_server;
	}

	public function test_options()
	{
		$expect = array('unittest' => NULL, 'test' => 'foo');

		$this->assert_equal(CLI::options('unittest', 'test'), $expect);
	}

} // End CLI
