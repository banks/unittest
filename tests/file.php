<?php defined('SYSPATH') or die('No direct script access.');

class UnitTest_File extends UnitTest_Case {

	// Temporary file name
	protected $_file;

	public function setup()
	{
		// Create a temporary file
		$this->_file = APPPATH.'cache/unittest_'.uniqid().'.txt';

		$file = fopen($this->_file, 'w+');

		for ($i = 0, $max = 4048; $i <= $max; $i++)
		{
			// Create lots of random text
			fwrite($file, str_repeat(chr(rand(32, 126)), 1024));
		}

		fclose($file);
	}

	public function teardown()
	{
		$files = glob($this->_file.'*');

		foreach ($files as $file)
		{
			if (is_file($file))
			{
				unlink($file);
			}
		}
	}

	public function test_mime()
	{
		$this
			->assert_equal(File::mime($this->_file), 'text/plain')
			->assert_equal(File::mime(__FILE__), 'application/x-httpd-php');
	}

	public function test_split_join()
	{
		$hash = sha1_file($this->_file);

		$this
			->assert_equal(File::split($this->_file, 1), 4)
			->assert_equal(File::join($this->_file), 4)
			->assert_equal(sha1_file($this->_file), $hash);
	}

} // End File
