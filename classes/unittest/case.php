<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract unit test case.
 *
 * @package    Unittest
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class UnitTest_Case {

	public static $disabled = FALSE;

	/**
	 * Executed before the test is run.
	 *
	 * @return  void
	 */
	public function setup()
	{
		// Nothing by default
	}

	/**
	 * Executed after the test has been run.
	 *
	 * @return  void
	 */
	public function teardown()
	{
		// Nothing by default
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

		return $this;
	}

	public function assert_null($value, $debug = NULL)
	{
		if ( ! is_null($value))
		{
			throw new UnitTest_Exception(':method: Expected a NULL but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_null($value, $debug = NULL)
	{
		if ( ! is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-NULL but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_boolean($value, $debug = NULL)
	{
		if ( ! is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a boolean but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_boolean($value, $debug = NULL)
	{
		if (is_bool($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-boolean but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_integer($value, $debug = NULL)
	{
		if ( ! is_int($value))
		{
			throw new UnitTest_Exception(':method: Expected an integer but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_integer($value, $debug = NULL)
	{
		if (is_int($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-integer but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_float($value, $debug = NULL)
	{
		if ( ! is_float($value))
		{
			throw new UnitTest_Exception(':method: Expected a float but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_float($value, $debug = NULL)
	{
		if (is_float($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-float but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_array($value, $debug = NULL)
	{
		if ( ! is_array($value))
		{
			throw new UnitTest_Exception(':method: Expected an array but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_array($value, $debug = NULL)
	{
		if (is_array($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-array but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_object($value, $debug = NULL)
	{
		if ( ! is_object($value))
		{
			throw new UnitTest_Exception(':method: Expected an object but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_object($value, $debug = NULL)
	{
		if (is_object($value))
		{
			throw new UnitTest_Exception(':method: Expected a non-object but was given (:type) :value', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_empty($value, $debug = NULL)
	{
		if ( ! empty($value))
		{
			throw new UnitTest_Exception(':method: Expected (:type) :value to be empty', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

		return $this;
	}

	public function assert_not_empty($value, $debug = NULL)
	{
		if (empty($value))
		{
			throw new UnitTest_Exception(':method: Expected (:type) :value to not be empty', array(
				':method' => __FUNCTION__,
				':type'   => gettype($value),
				':value'  => Kohana::dump($value),
			), $debug);
		}

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

		return $this;
	}

} // End UnitTest_Case
