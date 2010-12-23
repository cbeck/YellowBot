<html>
<head>
  <title>LocationMonitor.com - Dashboard</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
      <div class="grid_12 alpha omega">
      <?= $success = (isset($success))? $success: ''; ?>
      <h2 class="no_margin"><?= $user->name ?>&apos;s Dashboard</h2>
      <div id="dash_titles"><?= $user->business_name ?> | <?= $user->phone ?> | <?= $user->email ?></div>
        <div class="right"><a href="/business/add"><img src="/assets/images/add_business_btn.png"/></a></div>
        <h3>Additional Businesses</h3>
        <table width="100%">
          <thead>
            <tr>
              <td>Name</td>
              <td>Address</td>
              <td>Phone</td>
              <td>&nbsp;</td>
            </tr>
          </thead>
          <tbody>
        <?php foreach($businesses as $business): ?>
          <tr class="<?php echo alternator('odd', 'even') ?>">
            <td><?= $business->name ?></td>
            <td><?= $business->address1 ?>, <?= $business->city ?>, <?= $business->state ?> <?= $business->zip ?></td>
            <td><?= $business->phone ?></td>
            <td class="right"><a href="/user/partner_login">Manage Reputation</a></td>
          </tr>
        <?php endforeach; ?>
          </tbody>
        </table>

        <h3>Registered Businesses</h3>
        <table width="100%">
         <thead>
              <tr>
                <td>Name</td>
                <td>Address</td>
                <td>&nbsp;</td>
              </tr>
            </thead>
            <tbody>
        <?php foreach($yb_locations['locations'] as $yb_business): ?>
          <tr class="<?php echo alternator('odd', 'even') ?>">
            <td><?= $yb_business['name'] ?></td>
            <td><?= $yb_business['address'] ?>, <?= $yb_business['city'] ?>, <?= $yb_business['state'] ?> <?= $yb_business['zip'] ?></td>
            <td class="right"><a href="/user/partner_login">Manage Reputation</a></td>
          </tr>
        <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="clear"></div>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>