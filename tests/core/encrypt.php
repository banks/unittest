<?php defined('SYSPATH') or die('No direct script access.');

class UnitTest_Encrypt extends UnitTest_Case {

	// Encrypt instance
	protected $_encrypt;

	// Data to be encoded/decoded
	protected $_data = 'Hello, world! My name is Kohana.';

	public function setup()
	{
		$this->_encrypt = new Encrypt('secret key', MCRYPT_MODE_NOFB, MCRYPT_RIJNDAEL_128);
	}

	public function teardown()
	{
		$this->_encrypt = NULL;
	}

	public function test_encode_decode()
	{
		// Encode the data
		$data = $this->_encrypt->encode($this->_data);

		$this
			->assert_string($data)
			->assert_equal($this->_encrypt->decode($data), $this->_data);
	}

	

} // End Encrypt
