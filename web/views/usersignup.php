<html>
<head>
  <title>LocationMonitor.com - Sign up</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <div style="float: left;">
  			<h2>Sign up $19.95 month</h2>
  	  </div>
  		<div style="float: right; vertical-align: middle; width: 405px;">
  			<div style="float: left; padding-top: 20px;">
  				<a href="/pages/features"><span style="font-size: 24px; font-weight: bold;">See Service Features >></span></a>
  			</div>
  			<div style="float: right;">
  				<a href="/pages/features"><img src="/assets/images/Locationmonitor_Overview.jpg" height="100" border="0"></a>
  			</div>
  	  </div>
  	  <br clear="all">
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
        <label>Address Line 1:</label><input type="text" name="address1" value="<?= set_value('address1'); ?>" />
        </div>  
        <div class="rowElem">
        <label>Address Line 2:</label><input type="text" name="address2" value="<?= set_value('address2'); ?>" />
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
          <label>Type:</label>  
          <select name="cc_type">
            <option value="001">Visa</option>
            <option value="002">MasterCard</option>
            <option value="003">American Express</option>
            <option value="004">Discover</option>
          </select>
        </div>
        <div class="rowElem">
        <label>Credit Card #:</label><input type="text" name="cc_num" value="<?= set_value('cc_num'); ?>" />
        </div>   
        <div class="rowElem">    
          <label>Expiration:</label>  
          <select name="cc_exp_month">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <select name="cc_exp_year">
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
          </select>
        </div>
        <div class="rowElem">
        <label>CVV:</label><input type="text" name="cc_cvv" value="" size="4"/>
        </div>
       </fieldset> 
        <input type="submit" value="Submit" /> Billed at $59.85 per quarter 
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