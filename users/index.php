<?php
/**
 * users/index.php
 *
 * @package default
 */
// spaces before html can cause some servers to error.
$pageName = "CBC Gearpage login";
ob_start();
require_once '../database/load.php';
if ($session->isUserLoggedIn()) { redirect('../pages/index.php', false);}
if ($session->isUserLoggedIn()) { redirect('../pages/index.php', false);}
?>
<?php include_once '../pages/loginheader.php'; ?>
<div class="login-page">
    <div class="text-center">
       <h1>Welcome to CBC Gear-page</h1>
       <p>Sign in</p>
       <p></p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="../users/auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" value="" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" class="form-control" name="password" value="" placeholder="Password">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
    </form>
    <div class="text-center">
       <p>If you do not have login credentials check with Admin</p>
     </div>
</div>
<?php include_once '../pages/footer.php'; ?>
