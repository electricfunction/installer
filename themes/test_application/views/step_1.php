<h1>Step 1 - Server Check</h1>

<p>Before we begin, we're going to check that your server meets the requirements that the application needs to run properly. This won't hurt a bit! If everything shows as being green below, you're good to go on to the next step!</p>

<h3><?php echo ++$server_check_number; ?>. PHP and MySQL Version Tests</h3>
<table>
	<tr>
		<th></th>
		<th>Minimum</th>
		<th>Installed</th>
		<th width="15%">Result</th>
	</tr>
	
	<tr>
		<td>PHP</td>
		<td><?php echo $this->config->item('min_php_version') ?></td>
		<td><?php echo PHP_VERSION ?></td>
		<td>
			<?php
			if($php_pass):
				echo '<span style="color: green; font-weight: bold;">PASSED</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">FAILED</span>';
			endif;
			?>
		</td>
	</tr>
			
	<tr>
		<td>MySQL</td>
		<td><?php echo $this->config->item('min_mysql_version') ?></td>
		<td><?php echo mysql_version() ?></td>
		<td>
			<?php
			if($mysql_pass):
				echo '<span style="color: green; font-weight: bold;">PASSED</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">FAILED</span>';
			endif;
			?>
		</td>
	</tr>
</table>

<?php if($required_extension_pass): ?>
<h3><?php echo ++$server_check_number; ?>. Required PHP Extensions Tests</h3>
<table>
	<tr>
		<th>Extension</th>
		<th width="15%">Result</th>
	</tr>
	
	<?php
		foreach($required_extension_pass as $extension):
	?>
	<tr>
		<td><?php echo $extension['name'] ?></td>
		<td>
			<?php
			if($extension['result']):
				echo '<span style="color: green; font-weight: bold;">INSTALLED</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">NOT INSTALLED</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	?>
</table>
<?php endif; ?>

<?php if($optional_extension_pass): ?>
<h3><?php echo ++$server_check_number; ?>. Optional PHP Extensions Tests</h3>
<table>
	<tr>
		<th>Extension</th>
		<th width="15%">Result</th>
	</tr>
	
	<?php
		foreach($optional_extension_pass as $extension):
	?>
	<tr>
		<td><?php echo $extension['name'] ?></td>
		<td>
			<?php
			if($extension['result']):
				echo '<span style="color: green; font-weight: bold;">INSTALLED</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">NOT INSTALLED</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	?>
</table>
<?php endif; ?>

<?php if($enabled_php_ini || $disabled_php_ini): ?>
<h3><?php echo ++$server_check_number; ?>. PHP Settings Tests</h3>
<table>
	<tr>
		<th>Setting</th>
		<th width="15%">Result</th>
	</tr>
	
	<?php
		foreach($enabled_php_ini as $setting):
	?>
	<tr>
		<td><?php echo $setting['name'] ?></td>
		<td>
			<?php
			if($setting['result']):
				echo '<span style="color: green; font-weight: bold;">ENABLED</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">DISABLED</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	?>
	
	<?php
		foreach($disabled_php_ini as $setting):
	?>
	<tr>
		<td><?php echo $setting['name'] ?></td>
		<td>
			<?php
			if($setting['result']):
				echo '<span style="color: red; font-weight: bold;">ENABLED</span>';
			else:
				echo '<span style="color: green; font-weight: bold;">DISABLED</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	?>
</table>
<?php endif; ?>

<?php if($writable_directories || $writable_files): ?>
<h3><?php echo ++$server_check_number; ?>. Writable Directories and Files Tests</h3>
<table>
	<tr>
		<th>Directory/File</th>
		<th width="15%">Result</th>
	</tr>
	
	<?php
	if($writable_directories):
		foreach($writable_directories as $directory):
	?>
	<tr>
		<td><?php echo $directory['name'] ?></td>
		<td>
			<?php
			if($directory['writable']):
				echo '<span style="color: green; font-weight: bold;">WRITABLE</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">NOT WRITABLE</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	endif;
	?>
	
	<?php
	if($writable_files):
		foreach($writable_files as $file):
	?>
	<tr>
		<td><?php echo $file['name'] ?></td>
		<td>
			<?php
			if($file['writable']):
				echo '<span style="color: green; font-weight: bold;">WRITABLE</span>';
			else:
				echo '<span style="color: red; font-weight: bold;">NOT WRITABLE</span>';
			endif;
			?>
		</td>
	</tr>
	<?php
		endforeach;
	endif;
	?>
</table>
<?php endif; ?>

<p><?php echo anchor('step-2', 'Continue to Step 2 - MySQL Database', 'class="clean-gray"'); ?></p>