<?php defined('SYSPATH') or die('No direct script access.');

class UnitTest_Arr extends UnitTest_Case {

	public function test_is_assoc()
	{
		$index = array('one', 'two');
		$assoc = array('one' => 'foo', 'two' => 'bar');
		$mixed = array('one' => 'foo', 'bar');

		$this
			->assert_equal(Arr::is_assoc($index), FALSE)
			->assert_equal(Arr::is_assoc($assoc), TRUE)
			->assert_equal(Arr::is_assoc($mixed), TRUE);
	}

	public function test_extract()
	{
		$array = array('one' => 'foo', 'two' => 'bar');

		// The "one" and "xxx" keys should be present
		// "xxx" should be NULL, because it does exist
		$expect = array('one' => 'foo', 'xxx' => NULL);

		$this->assert_equal(Arr::extract($array, array('one', 'xxx'), NULL), $expect);
	}

	public function test_unshift()
	{
		$array = array('two' => 'bar');

		// The "one" key should be prepended to the array
		$expect = array('one' => 'foo') + $array;

		$this->assert_equal(Arr::unshift($array, 'one', 'foo'), $expect);
	}

	public function test_merge()
	{
		$one = array('index' => array(1, 2, 3), 'assoc' => array('x' => 0, 'y' => 100));
		$two = array('assoc' => array('x' => 15));

		// The value of "assoc/x" should change to 15
		$expect = $one;
		$expect['assoc']['x'] = 15;

		$this->assert_equal(Arr::merge($one, $two), $expect);
	}

	public function test_callback()
	{
		$callback = 'foo::bar(one,two,three)';

		// The valid callback and params
		$expect = array(
			array('foo', 'bar'),
			array('one', 'two', 'three')
		);

		$this->assert_equal(Arr::callback($callback), $expect);
	}

} // End UnitTest_Arr