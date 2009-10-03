<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Controller_UnitTest extends Controller {

	public function action_index()
	{
		// Display all unit tests
		$this->request->response = UnitTest::factory()->run();
	}

} // End UnitTest
