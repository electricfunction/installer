<?php if($sql_installed): ?>
<h1>Success!</h1>

<p>The database was installed successfully! This was the easiest step, huh?</p>

<p><?php echo anchor('hero/config', 'Continue to Configure Hero', 'class="clean-gray"'); ?></p>

<?php else: ?>

<h1>Uh Oh!</h1>

<p>We were unable to install the database to your server. Wanna check your database settings?</p>

<p><?php echo anchor('step-2', 'Go Back to Step 2 - MySQL Database', 'class="clean-gray"'); ?></p>
<?php endif; ?>