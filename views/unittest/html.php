<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style type="text/css">
#kohana-unit-test
{
	font-family: Monaco, 'Courier New';
	background-color: #F8FFF8;
	margin-top: 20px;
	clear: both;
	padding: 10px 10px 0;
	border: 1px solid #E5EFF8;
	text-align: left;
}
#kohana-unit-test pre
{
	margin: 0;
	padding: 4px;
	font: inherit;
}
#kohana-unit-test pre.source
{
	color: #111;
	background: #fff;
}
#kohana-unit-test pre.source span.line
{
	display: block;
}
#kohana-unit-test pre.source span.highlight
{
	background: #f0eb96;
}
#kohana-unit-test pre.source span.number
{
	color: #999;
}
#kohana-unit-test pre.debug
{
	background: #222;
}
#kohana-unit-test table
{
	font-size: 1.0em;
	color: #4D6171;
	width: 100%;
	border-collapse: collapse;
	border: 1px solid #E5EFF8;
	margin-bottom: 10px;
}
#kohana-unit-test th
{
	text-align: left;
	border-bottom: 1px solid #E5EFF8;
	background-color: #263038;
	padding: 3px;
	color: #FFF;
}
#kohana-unit-test td
{
	vertical-align: top;
	background-color: #FFF;
	border-bottom: 1px solid #E5EFF8;
	padding: 3px;
}
#kohana-unit-test .k-stats
{
	font-weight: normal;
	color: #83919C;
	text-align: right;
}
#kohana-unit-test .k-altrow td
{
	background-color: #F7FBFF;
}
#kohana-unit-test .k-name
{
	width: 25%;
	border-right: 1px solid #E5EFF8;
}
#kohana-unit-test .k-passed
{
	background-color: #E0FFE0;
}
#kohana-unit-test .k-altrow .k-passed
{
	background-color: #D0FFD0;
}
#kohana-unit-test .k-failed
{
	background-color: #991111;/*#FFE0E0;*/
        color:white;
}
#kohana-unit-test .k-altrow .k-failed
{
	background-color: #991111;/*#FFD0D0;*/
}
#kohana-unit-test .k-error
{
	background-color: #991111;/*#FFFFE0;*/
        color:white;
}
#kohana-unit-test .k-altrow .k-error
{
	background-color: #991111;/*#FFFFD1;*/
}
</style>

<div id="kohana-unit-test">

<?php foreach ($results as $class => $methods): ?>

	<table>
		<tr>
			<th><?php echo $class ?></th>
			<th class="k-stats">
				<?php printf('%s: %.2f%%', __('Score'), $stats[$class]['score']) ?> |
				<?php echo __('Total'),  ': ', $stats[$class]['total'] ?>,
				<?php echo __('Passed'), ': ', $stats[$class]['passed'] ?>,
				<?php echo __('Failed'), ': ', $stats[$class]['failed'] ?>,
				<?php echo __('Errors'), ': ', $stats[$class]['errors'] ?>
			</th>
		</tr>

		<?php if (empty($methods)): ?>

			<tr>
				<td colspan="2"><?php echo __('No tests found') ?></td>
			</tr>

		<?php else:

			foreach ($methods as $method => $result):

				// Hide passed tests from report
				if ($result === TRUE AND $hide_passed === TRUE)
					continue;

				?>

				<tr class="<?php echo text::alternate('', 'k-altrow') ?>">
					<td class="k-name"><?php echo $method ?></td>

					<?php if ($result === TRUE): ?>

						<td class="k-passed"><strong><?php echo __('Passed') ?></strong></td>

					<?php elseif ($result instanceof Unittest_Exception): ?>

						<td class="k-failed">
							<strong><?php echo __('Failed') ?></strong>
							<p><?php echo $result->getMessage() ?></p>
							<div><?php echo Kohana::debug_path($result->getFile()) ?> [ <?php echo $result->getLine() ?> ]</div>
							<pre class="source"><code><?php echo Kohana::debug_source($result->getFile(), $result->getLine()) ?></code></pre>
							<?php if (($debug = $result->getDebug()) !== NULL) echo Kohana::debug($debug) ?>
						</td>

					<?php elseif ($result instanceof Exception): ?>

						<td class="k-error">
							<strong><?php echo __('Error') ?></strong><br/>
							<p><?php echo $result->getMessage() ?></p>
							<div><?php echo Kohana::debug_path($result->getFile()) ?> [ <?php echo $result->getLine() ?> ]</div>
							<pre class="source"><code><?php echo Kohana::debug_source($result->getFile(), $result->getLine()) ?></code></pre>
						</td>

					<?php endif ?>

				</tr>

			<?php endforeach ?>

		<?php endif ?>

	</table>

<?php endforeach ?>

</div>
