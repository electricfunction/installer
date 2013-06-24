<?php echo validation_errors(); ?>

<?php echo form_open('hero/config', 'id="hero_configuration_settings"'); ?>

<div class="input">
	<label for="domain">Base Server URL</label>
	<input type="text" name="domain" id="domain" value="<?php echo set_value('domain', $domain); ?>">
</div>

<div class="input">
	<label for"site_name">Site Name</label>
	<input type="text" name="site_name" id="site_name" value="<?php echo set_value('site_name', $site_name); ?>">
</div>	

<div class="input">
	<label for"site_email">Site E-mail</label>
	<input type="text" name="site_email" id="site_email" value="<?php echo set_value('site_email', $site_email); ?>">
</div>

<input type="hidden" name="cron_key" id="cron_key" value="<?php echo $cron_key; ?>" />
<input type="hidden" name="encryption_key" id="encryption_key" value="<?php echo $encryption_key; ?>" />

<button type="submit" class="clean-gray">Save Configuration Settings</button>

<?php echo form_close(); ?>
