<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract unit test case.
 *
 * @package    Unittest
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Kohana_UnitTest_Case {

	public static $disabled = FALSE;

	public $assertion_count;
	
	/**
	 * Executed before each test is run.
	 *
	 * @return  void
	 */
	public function setup()
	{
		$this->assertion_count = 0;
	}

	/**
	 * Executed after each test has been run.
	 *
	 * @return  void
	 */
	public function teardown()
	{
		// Nothing by default
	}

	public function assert_true($value, $debug = NULL)
	{
		if ($value !== TRUE)
		{
			throw new UnitTest_Exception(':method: Expected :value to be TRUE', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_false($value, $debug = NULL)
	{
		if ($value !== FALSE)
		{
			throw new UnitTest_Exception(':method: Expected :value to be TRUE', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_equal($tested, $expected, $debug = NULL)
	{
		if ($tested !== $expected)
		{
			throw new UnitTest_Exception(':method: Expected :tested to be equal to :expected', array(
				':method'   => __FUNCTION__,
				':tested'   => Kohana::dump($tested),
				':expected' => Kohana::dump($expected),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_equal($tested, $expected, $debug = NULL)
	{
		if ($tested === $expected)
		{
			throw new UnitTest_Exception(':method: Expected :tested to be not equal to :expected', array(
				':method'   => __FUNCTION__,
				':tested'   => Kohana::dump($tested),
				':expected' => Kohana::dump($expected),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_similar($tested, $expected, $debug = NULL)
	{
		if ($tested != $expected)
		{
			throw new UnitTest_Exception(':method: Expected :tested to be similar to :expected', array(
				':method'   => __FUNCTION__,
				':tested'   => Kohana::dump($tested),
				':expected' => Kohana::dump($expected),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_similar($tested, $expected, $debug = NULL)
	{
		if ($tested == $expected)
		{
			throw new UnitTest_Exception(':method: Expected :tested to be similar to :expected', array(
				':method'   => __FUNCTION__,
				':tested'   => Kohana::dump($tested),
				':expected' => Kohana::dump($expected),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_null($value, $debug = NULL)
	{
		if ( ! is_null($value))
		{
			throw new UnitTest_Exception(':method: Expected a NULL but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_null($value, $debug = NULL)
	{
		if ( ! is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-NULL but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_boolean($value, $debug = NULL)
	{
		if ( ! is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a boolean but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_boolean($value, $debug = NULL)
	{
		if (is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-boolean but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_integer($value, $debug = NULL)
	{
		if ( ! is_int($value))
		{
			throw new UnitTest_Exception(':method: Expected an integer but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_integer($value, $debug = NULL)
	{
		if (is_int($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-integer but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_float($value, $debug = NULL)
	{
		if ( ! is_float($value))
		{
			throw new UnitTest_Exception(':method: Expected a float but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_float($value, $debug = NULL)
	{
		if (is_float($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-float but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_string($value, $debug = NULL)
	{
		if ( ! is_string($value))
		{
			throw new UnitTest_Exception(':method: Expected a string but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_string_contains($tested, $expected, $debug=NULL)
	{
		if (strpos($tested, $expected) === FALSE)
		{
			throw new UnitTest_Exception(':method: Expected to find :expected within :value', array(
				':method'   => __FUNCTION__,
				':value'    => $tested,
				':expected' => $expected,
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_string($value, $debug = NULL)
	{
		if (is_string($value))
		{
			throw new UnitTest_Exception(':method: Expected a string but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_array($value, $debug = NULL)
	{
		if ( ! is_array($value))
		{
			throw new UnitTest_Exception(':method: Expected an array but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_array($value, $debug = NULL)
	{
		if (is_array($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-array but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_object($value, $debug = NULL)
	{
		if ( ! is_object($value))
		{
			throw new UnitTest_Exception(':method: Expected an object but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_object($value, $debug = NULL)
	{
		if (is_object($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-object but was given :value', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($object),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_instance($object, $class, $debug = NULL)
	{
		if ( ! ($object instanceof $class))
		{
			throw new UnitTest_Exception(':method: Expected :object to be an instance of :class', array(
				':method' => __FUNCTION__,
				':object' => Kohana::dump($object),
				':class'  => $class,
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_instance($object, $class, $debug = NULL)
	{
		if ($object instanceof $class)
		{
			throw new UnitTest_Exception(':method: Expected :object to not be an instance of :class', array(
				':method' => __FUNCTION__,
				':object' => Kohana::dump($object),
				':class'  => $class,
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_empty($value, $debug = NULL)
	{
		if ( ! empty($value))
		{
			throw new UnitTest_Exception(':method: Expected :value to be empty', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_empty($value, $debug = NULL)
	{
		if (empty($value))
		{
			throw new UnitTest_Exception(':method: Expected :value to not be empty', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_count($value, $count, $debug = NULL)
	{
		if (count($value) !== $count)
		{
			throw new UnitTest_Exception(':method: Expected the count of :value to be :count', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':count'  => $count,
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_count($value, $count, $debug = NULL)
	{
		if (count($value) === $count)
		{
			throw new UnitTest_Exception(':method: Expected the count of :value to not be :count', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':count'  => $count,
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_in_array($value, array $array, $debug = NULL)
	{
		if ( ! in_array($value, $array))
		{
			throw new UnitTest_Exception(':method: Expected :value to be in :array', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':array'  => Kohana::dump($array),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_in_array($value, array $array, $debug = NULL)
	{
		if (in_array($value, $array))
		{
			throw new UnitTest_Exception(':method: Expected :value to not be in :array', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':array'  => Kohana::dump($array),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_isset($key, array $array, $debug = NULL)
	{
		if ( ! isset($array[$key]))
		{
			throw new UnitTest_Exception(':method: Expected the :key to be set in :array', array(
				':method' => __FUNCTION__,
				':key'    => Kohana::dump($value),
				':array'  => Kohana::dump($array),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_isset($key, array $array, $debug = NULL)
	{
		if (isset($array[$key]))
		{
			throw new UnitTest_Exception(':method: Expected the :key to not be set in :array', array(
				':method' => __FUNCTION__,
				':key'    => Kohana::dump($value),
				':array'  => Kohana::dump($array),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_regex_match($value, $regex, $debug = NULL)
	{
		if ( ! preg_match($regex, $value))
		{
			throw new UnitTest_Exception(':method: Expected :value to be matched by :pattern', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':regex'  => Kohana::dump($regex),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

	public function assert_not_regex_match($value, $regex, $debug = NULL)
	{
		if (preg_match($regex, $value))
		{
			throw new UnitTest_Exception(':method: Expected :value to not be matched by :pattern', array(
				':method' => __FUNCTION__,
				':value'  => Kohana::dump($value),
				':regex'  => Kohana::dump($regex),
			), $debug);
		}

		$this->assertion_count ++;
		return $this;
	}

} // End UnitTest_Case
