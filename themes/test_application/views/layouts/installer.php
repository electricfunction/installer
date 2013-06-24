<!DOCTYPE HTML>
<html>

<head>
  <title><?php echo $template['title']; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/test_application/css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><?php echo $this->config->item('application_name'); ?></h1>
          <h2>Installation Unicorn (because they're cooler than wizards.)</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><?php echo anchor('welcome', 'Welcome') ?></li>
        </ul>
      </nav>
    </header>
    <div id="site_content">
      
      <div id="content">
        <?php echo $template['body']; ?>
      </div>
    </div>
    <footer>
      <p><?php echo anchor($this->config->item('application_url'), $this->config->item('application_name')); ?> Installer - Page rendered in <strong>{elapsed_time}</strong> seconds</p>
    </footer>
  </div>
  <p>&nbsp;</p>

</body>
</html>