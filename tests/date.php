<?php defined('SYSPATH') or die('No direct script access.');

class UnitTest_Date extends UnitTest_Case {

	protected $_timezone;

	public function setup()
	{
		$this->_timezone = date_default_timezone_get();

		// Set the timezone to GMT
		date_default_timezone_set('GMT');
	}

	public function teardown()
	{
		date_default_timezone_set($this->_timezone);
	}

	public function test_offset()
	{
		$remote = 'Etc/GMT-1';

		$this->assert_equal(Date::offset($remote), Date::HOUR);
	}

	public function test_seconds()
	{
		$expect = array(0 => '00', 15 => '15', 30 => '30', 45 => '45');

		$this->assert_equal(Date::seconds(15), $expect);
	}

	public function test_minutes()
	{
		$expect = array(0 => '00', 15 => '15', 30 => '30', 45 => '45');

		$this->assert_equal(Date::minutes(15), $expect);
	}

	public function test_hours()
	{
		for ($i = 1; $i <= 12; $i++)
		{
			$expect[$i] = (string) $i;
		}

		$this->assert_equal(Date::hours(), $expect);
	}

	public function test_ampm()
	{
		$this
			->assert_equal(Date::ampm(1), 'AM')
			->assert_equal(Date::ampm(13), 'PM');
	}

	public function test_adjust()
	{
		$hour = 1;

		$this
			->assert_equal(Date::adjust($hour, 'AM'), '01')
			->assert_equal(Date::adjust($hour, 'PM'), '13');
	}

	public function test_days()
	{
		$month = 1;

		for ($i = 1; $i <= 31; $i++)
		{
			$expect[$i] = (string) $i;
		}

		$this->assert_equal(Date::days($month), $expect);
	}

	public function test_months()
	{
		for ($i = 1; $i <= 12; $i++)
		{
			$expect[$i] = (string) $i;
		}

		$this->assert_equal(Date::months(), $expect);
	}

	public function test_years()
	{
		for ($i = 2005, $max = 2010; $i <= $max; $i++)
		{
			$expect[$i] = (string) $i;
		}

		$this->assert_equal(Date::years(2005, 2010), $expect);
	}

	public function test_span()
	{
		$expect = array('minutes' => 1, 'seconds' => 10);

		$this->assert_equal(Date::span(time() - 70, NULL, 'minutes,seconds'), $expect);
	}

	public function test_fuzzy_span()
	{
		$expect = 'moments ago';

		$this->assert_equal(Date::fuzzy_span(time() - 5), $expect);
	}

} // End Date
