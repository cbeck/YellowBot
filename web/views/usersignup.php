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
      <?php $attributes = array('class' => 'jqtransform', 'id' => 'signup_form'); ?>
      <?= form_open('user/signup', $attributes); ?>
      <div class="grid_6 alpha">
      <fieldset>
        <legend>About You</legend>
        <div class="rowElem">
        <label>Name</label><input type="text" name="name" value="<?= set_value('name'); ?>" />
        </div> 
        <div class="rowElem">
        <label>Email</label><input type="text" name="email" value="<?= set_value('email'); ?>" />
        </div>
        <div class="rowElem">
        <label>Password</label><input type="password" name="password" value="" />
        </div>
        <div class="rowElem">
        <label>Password Confirmation</label><input type="password" name="passwordconf" value="" />
        </div>
      </fieldset>
      </div>
      <div class="grid_6 omega pad_top_20">
        <p>This will be the account holder information for any one or multiple businesses monitored through this profile. We will not use this information for anything other than LocationMonitor.com communications. It will not be sold to marketers or used for delivery of advertising.</p>
      </div>
      <div class="clear"></div>
      <div class="grid_6 alpha">
      <fieldset>
        <legend>About Your Business</legend>
        <div class="rowElem">
        <label>Business Name:</label><input type="text" name="business_name" value="<?= set_value('business_name'); ?>" />
        </div>
        <div class="rowElem">
        <label>Address:</label><input type="text" name="address1" value="<?= set_value('address1'); ?>" />
        </div>  
        <div class="rowElem">
        <label>Address:</label><input type="text" name="address2" value="<?= set_value('address2'); ?>" />
        </div>
        <div class="rowElem">
        <label>City:</label><input type="text" name="city" value="<?= set_value('city'); ?>" />
        </div>
        <div class="rowElem">
        <label>State:</label><input type="text" name="state" value="<?= set_value('state'); ?>" /> 
        </div>
        <div class="rowElem">
        <label>Zip:</label><input type="text" name="zip" value="<?= set_value('zip'); ?>" />
        </div>
        <div class="rowElem">
        <label>Phone:</label><input type="text" name="phone" value="<?= set_value('phone'); ?>" />
        </div>
       </fieldset>
       </div>
       <div class="grid_6 omega pad_top_20">
         <p>This does not have to be the business you wish to track, but will be an assumed option for one. You will be able to add other businesses through this account.</p>
       </div>
       <div class="clear"></div>
       <div class="grid_6 alpha">
       <fieldset>
         <legend>Payment Information</legend>
         <div class="rowElem">
        <label>Name on Card:</label><input type="text" name="cc_name" value="<?= set_value('cc_name'); ?>" />
        </div>
        <div class="rowElem">
        <label>Type:</label><input type="text" name="cc_type" value="<?= set_value('cc_type'); ?>" />
        </div>
        <div class="rowElem">
        <label>Credit Card #:</label><input type="text" name="cc_num" value="<?= set_value('cc_num'); ?>" />
        </div>   
        <div class="rowElem">    
        <label>Expiration Month:</label><input type="text" name="cc_exp_month" value="<?= set_value('cc_exp_month'); ?>" />
        </div>
        <div class="rowElem">
        <label>Expiration Year:</label><input type="text" name="cc_exp_year" value="<?= set_value('cc_exp_year'); ?>" />
        </div>
        <div class="rowElem">
        <label>CVV:</label><input type="text" name="cc_cvv" value="" />
        </div>
       </fieldset> 
        <input type="submit" value="Submit" />
      </div>
      <div class="grid_6 omega pad_top_20">
        <p>Your card will be billed quarterly in advance. You may cancel any time and delete this account. Your information is not stored by us but by our merchant processor, CyberSource, with high level security.</p>
      </div>
      <div class="clear"></div>
      <?= form_close(); ?>
      </div>      
      <div class="clear"></div>
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