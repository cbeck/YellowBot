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
      
      <ul>
        <li>Name: <?= $user->name ?></li>
        <li>Business Name: <?= $user->business_name ?></li>
        <li>Phone: <?= $user->phone ?></li>
        <li>Email: <?= $user->email ?></li>
        <li><a href="/user/partner_login">Login to YB</a></li>
        <li><a href="/business/add">Add a new business</a></li>
      </ul>
      
      <h3>Additional Businesses</h3>
      <table width="100%">
      <?php foreach($businesses as $business): ?>
        <tr>
          <td><?= $business->name ?></td>
          <td><?= $business->address1.'<br />'.$business->address2 ?></td>
          <td><?= $business->city ?></td>
          <td><?= $business->state ?></td>
          <td><?= $business->zip ?></td>
          <td><?= $business->phone ?></td>
        </tr>
      <?php endforeach; ?>
      </table>

      <h3>Registered Businesses</h3>
      <table width="100%">
      <?php foreach($yb_locations['locations'] as $yb_business): ?>
        <tr>
          <td><?= $yb_business['name'] ?></td>
          <td><?= $yb_business['address'] ?></td>
          <td><?= $yb_business['city'] ?></td>
          <td><?= $yb_business['state'] ?></td>
          <td><?= $yb_business['zip'] ?></td>
        </tr>
      <?php endforeach; ?>
      </table>

      <pre>
        <?php
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