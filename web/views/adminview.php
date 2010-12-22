<html>
<head>
  <title>LocationMonitor.com - About us</title>
  <?php include("includes/doc_head.inc"); ?>
</head>
<body>
  <div id="canvas" class="container_12">
    <?php include("includes/header.inc"); ?>
    <div id="main" class="container_12">
    <h2>Users</h2>
    <table style="width: 100%;">
      <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>Address</td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
      <?php foreach($user_table as $user_row): ?>
        <tr class="<?php echo alternator('odd', 'even') ?>">
          <td><?= $user_row->name ?></td>
          <td><?= $user_row->email ?></td>
          <td><?= $user_row->address1.' '.$user_row->address2.'<br />'.$user_row->city.', '.$user_row->state.' '.$user_row->zip ?></td>
          <td>
          <?= anchor('user/remove/'.$user_row->id, 'Delete', 'title="Delete"'); ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <h2>Users with unregistered businesses</h2>
    <table style="width: 100%;">
      <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>Address</td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
      <?php foreach($user_unregistered_table as $user_row): ?>
        <tr class="<?php echo alternator('odd', 'even') ?>">
          <td><?= $user_row->name ?></td>
          <td><?= $user_row->email ?></td>
          <td><?= $user_row->address1.' '.$user_row->address2.'<br />'.$user_row->city.', '.$user_row->state.' '.$user_row->zip ?></td>
          <td>
          <?= anchor('user/remove/'.$user_row->id, 'Delete', 'title="Delete"'); ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>    
    <hr />
    <h2>Admins</h2>
    <table>
      <thead>
        <tr class="odd">
          <td>Username</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
      <?php foreach($admin_table as $admin_row): ?>
        <tr>
          <td><?= $admin_row->username ?></td>
          <td><?= anchor('admin/remove/'.$admin_row->id, 'Delete', 'title="Delete"'); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>    
    <?php echo validation_errors(); ?>
    <?php echo form_open('admin/add'); ?>
      <h5>Username</h5>
      <input type="text" name="new_username" value="<?= set_value('new_username'); ?>" />    
      <h5>Password</h5>
      <input type="password" name="new_password" value="" />
      <h5>Confirm Password</h5>
      <input type="password" name="new_password_confirm" value="" />
      <input type="submit" value="Add" />
    </form>
    </div>
    <?php include("includes/footer.inc"); ?>  
  </div>
</body>
</html>