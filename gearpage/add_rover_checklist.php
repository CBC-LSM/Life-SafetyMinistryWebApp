<?php
/**
 * add_user.php
 *
 * @package default
 */


$pageName = 'Add To Rover Checklist';
require_once '../database/load.php';
include '../pages/header.php';
// Checkin What level user has permission to view this page
if ($_SESSION['userLevel']<1 && $_SESSION['userLevel']>3) {redirect('/', false);}

?>
<div class="message-text-center">
  <?php echo display_msg($msg); ?>
</div>
<div class="login-page">
<div class="text-center">
        <h1>Add Checklist Item</h1>
    </div>
        <form method="post" action="../features/add_item.php">
        <div class="form-group">
            <textarea id="text_input" name="text_input" rows="4" cols="50" placeholder="Enter New Item"></textarea>
        </div>
        <div class="form-group clearfix">
            <button type="submit" name="insert_item" class="btn btn-primary">Insert Item</button>
        </div>
    </form>
</div>
</div>

<?php include_once '../pages/footer.php'; ?>
