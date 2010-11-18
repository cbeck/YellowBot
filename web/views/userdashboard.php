<html>
<head>
  <title>LocationMonitor.com - Dashboard</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <p><?= $success = (isset($success))? $success: ''; ?></p>
      
      <a href="/user/partner_login">Login to YB</a>
      <a href="/business/add">Add a new business</a>
      <pre>
      <?
      print_r($user);
      print_r($businesses);
      print_r($yb_locations);
      ?>
      </pre>
      
      
      
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>