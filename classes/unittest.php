<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Unittest library.
 *
 * @package    UnitTest
 * @author     Kohana Team
 * @copyright  (c) 2007-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class UnitTest {

	/**
	 * Create a new UnitTest instance.
	 *
	 * @param   array  list of files to execute
	 * @return  UnitTest
	 */
	public static function factory(array $paths = NULL)
	{
		return new UnitTest($paths);
	}

	/**
	 * @var  boolean  Hide passed results?
	 */
	public $hide_passed = FALSE;

	/**
	 * @var  array  Results of each test, organized by class
	 */
	public $results = array();

	/**
	 * @var  array  Statistics of each test, organized by class
	 */
	public $stats = array();

	// Tests to execute
	protected $_tests = array();

	/**
	 * Set the tests to be run.
	 *
	 * @param   array  list of files to execute
	 * @return  void
	 */
	public function __construct(array $tests = NULL)
	{
		if ($tests === NULL)
		{
			// Load all tests
			$tests = Kohana::list_files('tests');
		}
		else
		{
			// Normalize the file name
			$tests = array_map('realpath', $tests);
		}

		// Take out duplicate test paths
		$tests = array_unique($tests);

		foreach ($tests as $file)
		{
			if (substr($file, -(strlen(EXT))) !== EXT)
			{
				// This is not a test file
				continue;
			}

			// Extract the class name from the path
			$class = 'UnitTest_'.ucfirst(pathinfo($file, PATHINFO_FILENAME));

			// Include the test only once
			include_once $file;

			try
			{
				// Start class analysis
				$reflection = new ReflectionClass($class);
			}
			catch (ReflectionException $e)
			{
				throw new Kohana_Exception('UnitTest file :file must declare :class',
					array(':file' => Kohana::debug_path($file), ':class' => $class));
			}

			if ( ! $reflection->isSubclassOf('UnitTest_Case'))
			{
				throw new Kohana_Exception('UnitTest :class must be an extension of UnitTest_Case',
					array(':class' => $class));
			}

			if ($reflection->getStaticPropertyValue('disabled') === TRUE)
			{
				// Skip all disabled tests
				continue;
			}

			// Add this test to the list with
			$this->_tests[$file] = $reflection;
		}
	}

	/**
	 * Magically convert this object to a string.
	 *
	 * @return  string  test report
	 */
	public function __toString()
	{
		try
		{
			return (string) $this->report();
		}
		catch (Exception $e)
		{
			return $e->getMessage().' in '.Kohana::debug_path($e->getFile()).' [ '.$e->getLine().' ]';
		}
	}

	/**
	 * Run all unit tests. Results and stats will be populated as each test
	 * is executed.
	 *
	 * @return  $this
	 */
	public function run()
	{
		// Reset the stats and results
		$this->stats = $this->results = array();

		foreach ($this->_tests as $file => $class)
		{
			// Create a new instance of this class
			$object = $class->newInstance();

			// Set the class name, remove the "UnitTest_" prefix
			$_class  = substr($class->name, 9);

			if ( ! isset($this->stats[$_class]))
			{
				// Initialize the stats for this test
				$this->stats[$_class] = array(
					'total'  => 0,
					'passed' => 0,
					'failed' => 0,
					'errors' => 0,
					'score'  => 0,
				);
			}

			if ( ! isset($this->results[$_class]))
			{
				// Initialize the results for this test
				$this->results[$_class] = array();
			}

			// Get the test setup
			$object->setup();

			foreach ($class->getMethods() as $method)
			{
				if ( ! $method->isPublic() OR substr($method->name, 0, 5) !== 'test_')
				{
					// This is not a test method
					continue;
				}

				// Set the method name, remove the "test_" prefix
				$_method = substr($method->name, 5);

				try
				{
					// Run $object->$method() with Reflection
					$method->invoke($object);

					// Test passed
					$this->results[$_class][$_method] = TRUE;
					$this->stats[$_class]['passed']++;
				}
				catch (UnitTest_Exception $e)
				{
					// Test failed
					$this->results[$_class][$_method] = $e;
					$this->stats[$_class]['failed']++;
				}
				catch (Exception $e)
				{
					// Test error
					$this->results[$_class][$_method] = $e;
					$this->stats[$_class]['errors']++;
				}

				// A test has been executed
				$this->stats[$_class]['total']++;
			}

			if ($this->stats[$_class]['total'] > 0)
			{
				// Calculate score
				$this->stats[$_class]['score'] = $this->stats[$_class]['passed'] * 100 / $this->stats[$_class]['total'];
			}

			// Clean up the test
			$object->teardown();
		}

		return $this;
	}

	/**
	 * Generates nice test results in HTML or text form.
	 *
	 * @param   boolean  render HTML
	 * @return  string
	 */
	public function report($html = NULL)
	{
		// No tests found
		if (empty($this->results))
			return __('No tests have been executed');

		if ($html === NULL)
		{
			// Display HTML when not in command-line mode
			$html = ! Kohana::$is_cli;
		}

		if ($html === FALSE)
		{
			// Load the text display
			$report = View::factory('unittest/text');
		}
		else
		{
			// Load the HTML display
			$report = View::factory('unittest/html');
		}

		// Render UnitTest report
		return $report->set('results', $this->results)
					  ->set('stats', $this->stats)
					  ->set('hide_passed', $this->hide_passed)
					  ->render();
	}

} // End UnitTest
