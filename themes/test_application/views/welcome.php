<h1>Welcome to the <?php echo $this->config->item('application_name'); ?> installer</h1>

<p>We are excited you've decided to install <?php echo $this->config->item('application_name'); ?> on your server! Please be sure to have your MySQL database created and information on hand before you begin. You'll need the following information:</p>

<ul>
	<li><b>Database Host</b> - The address pointing to your database server.</li>
	<li><b>Database Name</b> - The name of the database on your server.</li>
	<li><b>Database Username &amp; Password</b> - Your database username and password login credentials.</li>	
</ul>

<p>When you're ready to continue, this installation process should take no less than a couple minutes of your time. So go ahead and click on to the first step!</p>

<p><?php echo anchor('step-1', 'Continue to Step 1 - Server Check', 'class="clean-gray"'); ?></p>