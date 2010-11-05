<html>
<head>
  <title>LocationMonitor.com - About us</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <div class="grid_6 suffix_6">
      <h3>Login</h3>
      <?= validation_errors(); ?>
      <h5><?= $this->session->flashdata('success'); ?></h5>
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