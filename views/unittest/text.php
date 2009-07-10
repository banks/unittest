<?php defined('SYSPATH') OR die('No direct access allowed.');

echo "\n", str_repeat('-', 80), "\n\n";

foreach ($results as $class => $methods)
{
	echo __('UnitTest'), ": {$class} \n";
	echo __('Score'),  ': ', sprintf('%.2f%%', $stats[$class]['score']), " \t";
	echo __('Total'),  ": {$stats[$class]['total']}\t";
	echo __('Passed'), ": {$stats[$class]['passed']}\t";
	echo __('Failed'), ": {$stats[$class]['failed']}\t";
	echo __('Errors'), ": {$stats[$class]['errors']}\n\n";

	// Get the longest method name in this set
	$length = max(array_map('strlen', array_keys($methods))) + 3;

	// Set the indentation for this set
	$indent = str_repeat(' ', $length);

	foreach ($methods as $method => $result)
	{
		if ($hide_passed === TRUE AND $result === TRUE)
		{
			// Hide passed tests from report
			continue;
		}

		printf('%-'.$length.'s', $method.':');

		if ($result === TRUE)
		{
			echo __('Passed'), "\n";
		}
		elseif ($result instanceof UnitTest_Exception)
		{
			echo __('Failed'), "\n{$indent}", strip_tags(str_replace(array("\n", "\t"), '', $result->getMessage())), "\n";

			if (($debug = $result->getDebug()) !== NULL)
			{
				echo "{$indent}", strip_tags(Kohana::debug($debug)), "\n";
			}
		}
		else
		{
			echo __('Error'), "\n{$indent}", strip_tags(str_replace(array("\n", "\t"), '', $result->getMessage())), "\n";
		}
	}

	echo "\n", str_repeat('-', 80), "\n\n";
}
