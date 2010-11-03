<html>
<head>
  <title>LocationMonitor.com - About us</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <?= validation_errors(); ?>
  		<?= form_open('admin/login'); ?>
  			<h5>Username</h5>
  			<input type="text" name="username" value="<?= set_value('username'); ?>" />		
  			<h5>Password</h5>
  			<input type="password" name="password" value="" />
  			<input type="submit" value="Submit" />
  		<?= form_close(); ?>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>