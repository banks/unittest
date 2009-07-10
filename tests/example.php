<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Example Test.
 *
 * @package    Unit_Test
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class UnitTest_Example extends UnitTest_Case {

	public $setup_has_run = FALSE;

	public function setup()
	{
		$this->setup_has_run = TRUE;
	}

	public function test_setup()
	{
		$this->assert_equal($this->setup_has_run, TRUE);
	}

	public function test_true_false()
	{
		$var = TRUE;
		$this
			->assert_equal($var, TRUE)
			->assert_equal( ! $var, FALSE);
	}

	public function test_equal_same()
	{
		$var = '5';
		$this
			->assert_equal($var, '5')
			->assert_similar($var, 5)
			->assert_not_equal($var, '6')
			->assert_not_similar($var, 6);
	}

	public function test_type()
	{
		$this
			->assert_boolean(TRUE)
			->assert_not_boolean('TRUE')
			->assert_integer(123)
			->assert_not_integer('123')
			->assert_float(1.23)
			->assert_not_float(123)
			->assert_array(array(1, 2, 3))
			->assert_not_array('array()')
			->assert_object(new stdClass)
			->assert_not_object('X')
			->assert_null(NULL)
			->assert_not_null(0)
			->assert_empty('0')
			->assert_not_empty('1');
	}

	public function test_pattern()
	{
		$var = "Kohana\n";
		$this
			->assert_regex_match($var, '/^Kohana$/')
			->assert_not_regex_match($var, '/^Kohana$/D');
	}

	public function test_array_key()
	{
		$array = array('a' => 'A', 'b' => 'B');
		$this->assert_isset('a', $array);
	}

	public function test_in_array()
	{
		$array = array('X', 'Y', 'Z');
		$this->assert_in_array('X', $array);
	}

	public function test_similar()
	{
		$a = TRUE;
		$b = 'ok';

		$this->assert_similar($a, $b);
	}

	public function test_debug_example()
	{
		foreach (array(1, 5, 6, 12, 65, 128, 9562) as $var)
		{
			// By supplying $var in the debug parameter,
			// we can see on which number this test fails.
			$this->assert_equal($var < 100, TRUE, $var);
		}
	}

	public function test_error()
	{
		throw new Exception;
	}

}