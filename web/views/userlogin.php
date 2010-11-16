<html>
<head>
  <title>LocationMonitor.com - Sign In</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      
      <h3>Login</h3>
      <p><?= $unregistered = (isset($unregistered))? $unregistered: ''; ?></p>
      <?= validation_errors(); ?>
      <div class="grid_6 alpha">
        <?php $attributes = array('class' => 'jqtransform', 'id' => 'login_form'); ?>
        <?= form_open('user/login', $attributes); ?>
        <fieldset>
          <div class="rowElem">        
              <label name="email">Email</label>
              <input type="text" name="email" value="<?= set_value('email'); ?>" /> 
          </div>
          <div class="rowElem">
              <label name="password">Password</label>
              <input type="password" name="password" value="" />
          </div>        
        </fieldset>
        <div class="rowElem">
          <input type="submit" value="Submit" />
        </div>
        <?= form_close(); ?>
      </div>
      <div class="grid_6 omega">
        <p><?= $success = (isset($success))? $success: ''; ?></p>
        <p><strong>Welcome back!</strong></p>
        <p>If this is your first visit to the site, you will need to <a href="/user/signup">Sign Up</a> to create an account.</p>
      </div>
      <div class="clear"></div>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
  <script type="text/javascript">
  $(function() {
      //find all form with class jqtransform and apply the plugin
      $("form.jqtransform").jqTransform();
  });
  </script>
</body>
</html>