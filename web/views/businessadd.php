<html>
<head>
  <title>LocationMonitor.com - Add a Business</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <h2>Add a business</h2>
      <?= validation_errors(); ?>
      <?php $attributes = array('class' => 'jqtransform', 'id' => 'signup_form'); ?>
      <?= form_open('business/add', $attributes); ?>
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
         <p></p>
       </div>
       <div class="clear"></div>
       <div class="grid_6 alpha">
       <fieldset>
         <legend>Payment Information</legend>
        <div class="rowElem">
        <label>Name on Card:</label><input type="text" name="cc_name" value="<?= set_value('cc_name'); ?>" />
        </div>
        <div class="rowElem">
        <label>Address Line 1:</label><input type="text" name="cc_address1" value="<?= set_value('cc_address1'); ?>" />
        </div>  
        <div class="rowElem">
        <label>Address Line 2:</label><input type="text" name="cc_address2" value="<?= set_value('cc_address2'); ?>" />
        </div>
        <div class="rowElem">
        <label>City:</label><input type="text" name="cc_city" value="<?= set_value('cc_city'); ?>" />
        </div>
        <div class="rowElem">
        <label>State:</label><input type="text" name="cc_state" value="<?= set_value('cc_state'); ?>" /> 
        </div>
        <div class="rowElem">
        <label>Zip:</label><input type="text" name="cc_zip" value="<?= set_value('cc_zip'); ?>" />
        </div>
        <div class="rowElem">
        <label>Phone:</label><input type="text" name="cc_phone" value="<?= set_value('cc_phone'); ?>" />
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