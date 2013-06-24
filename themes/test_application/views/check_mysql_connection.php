<?php if($db_connected): ?>
<h1>Success!</h1>

<p>Looks like we were able to establish a connection with your database! Your connection settings have been saved to the database configuration file and you may now proceed on to the next step!</p>

<p><?php echo anchor('step-3', 'Continue to Step 3 - Install Database', 'class="clean-gray"'); ?></p>

<?php else: ?>

<h1>Uh Oh!</h1>

<p>We were unable to establish a connection with your database with the information you supplied. Please verify that the information you supplied was correct.</p>

<p><?php echo anchor('step-2', 'Go Back to Step 2 - MySQL Database', 'class="clean-gray"'); ?></p>
<?php endif; ?>