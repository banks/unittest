<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Controller_UnitTest extends Controller {

	public function action_index()
	{
		// Display all Unit tests found by default
		$tests = NULL;
		
		if ($this->request->param('test_dir') !== NULL)
		{
			$tests = UnitTest::find_tests($this->request->param('test_dir'));
		}
		
		// Display requested tests
		$this->request->response = UnitTest::factory($tests)->run();
	}

} // End UnitTest
