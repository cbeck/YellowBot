<html>
<head>
  <title>LocationMonitor.com - Sign up</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <h2>Sign up</h2>
      <?= validation_errors(); ?>
      <?= form_open('user/signup'); ?>
        <label>Name:</label><input type="text" name="name" value="<?= set_value('name'); ?>" /><br />   
        <label>Email:</label><input type="text" name="email" value="<?= set_value('email'); ?>" /><br />  
        <label>Password:</label><input type="password" name="password" value="" /><br />
        <label>Password Confirmation:</label><input type="password" name="passwordconf" value="" /><br />
        <hr />
        <label>Business Name:</label><input type="text" name="business_name" value="<?= set_value('business_name'); ?>" /><br />
        <label>Address:</label><input type="text" name="address1" value="<?= set_value('address1'); ?>" /><br />  
        <label>Address:</label><input type="text" name="address2" value="<?= set_value('address2'); ?>" /><br />  
        <label>City:</label><input type="text" name="city" value="<?= set_value('city'); ?>" /><br />  
        <label>State:</label><input type="text" name="state" value="<?= set_value('state'); ?>" /><br />  
        <label>Zip:</label><input type="text" name="zip" value="<?= set_value('zip'); ?>" /><br />  
        <label>Phone:</label><input type="text" name="phone" value="<?= set_value('phone'); ?>" /><br /> 
        <hr />
        <label>Name on Card:</label><input type="text" name="cc_name" value="<?= set_value('cc_name'); ?>" /><br /> 
        <label>Type:</label><input type="text" name="cc_type" value="<?= set_value('cc_type'); ?>" /><br />
        <label>Credit Card #:</label><input type="text" name="cc_num" value="<?= set_value('cc_num'); ?>" /><br />          
        <label>Expiration Month:</label><input type="text" name="cc_exp_month" value="<?= set_value('cc_exp_month'); ?>" /><br /> 
        <label>Expiration Year:</label><input type="text" name="cc_exp_year" value="<?= set_value('cc_exp_year'); ?>" /><br /> 
        <label>CVV:</label><input type="text" name="cc_cvv" value="" /><br />  
        
        <input type="submit" value="Submit" />
      <?= form_close(); ?>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>