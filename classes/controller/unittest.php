<?php defined('SYSPATH') or die('No direct script access.');

class Controller_UnitTest extends Controller {

	public function action_index()
	{
		// Display all unit tests
		$this->request->response = UnitTest::factory()->run();
	}

} // End UnitTest
