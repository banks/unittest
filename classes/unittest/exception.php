<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Unit test exceptions.
 *
 * @package    Unittest
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class UnitTest_Exception extends Kohana_Exception {

	// Debugging information
	protected $debug;

	/**
	 * Sets exception message and debug info.
	 *
	 * @param   string  message
	 * @param   mixed   debug info
	 * @return  void
	 */
	public function __construct($message, array $variables = NULL, $debug = NULL)
	{
		// Failure message
		parent::__construct($message, $variables);

		// Set the debug information
		$this->debug = $debug;

		// Load the stack trace
		$trace = $this->getTrace();

		// Set the error location to the assertation call
		$this->file = $trace[0]['file'];
		$this->line = $trace[0]['line'];
	}

	/**
	 * Returns the debug information associated with this exception.
	 *
	 * @return  mixed
	 */
	public function getDebug()
	{
		return $this->debug;
	}

} // End UnitTest_Exception
