<?php echo validation_errors(); ?>

<?php echo form_open('step-2', 'id="mysql_information"'); ?>

<div class="input">
	<label for="hostname">Hostname</label>
	<input type="text" name="hostname" id="hostname" value="<?php echo set_value('hostname'); ?>">
</div>

<div class="input">
	<label for"username">Username</label>
	<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
</div>	

<div class="input">
	<label for"password">Password</label>
	<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>">
</div>

<div class="input">
	<label for"database">Database</label>
	<input type="text" name="database" id="database" value="<?php echo set_value('database'); ?>">
</div>

<button type="submit" class="clean-gray">Check Connection</button>

<?php echo form_close(); ?>
