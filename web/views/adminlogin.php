<html>
<head>
  <title>LocationMonitor.com - About us</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
    		<?php echo validation_errors(); ?>
		<?php echo form_open('admin'); ?>
			<h5>Username</h5>
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" />		
			<h5>Password</h5>
			<input type="password" name="password" value="" />
			<input type="submit" value="Submit" />
		</form>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>