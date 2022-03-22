<?php
/**
 * add_user.php
 *
 * @package default
 */


$page_title = 'Add User';
require_once '../database/load.php';
include '../pages/header.php';
// Checkin What level user has permission to view this page
if (!$_SESSION['userLevel']==1) { redirect('../pages/index.php', false);}

$groups = find_all('user_groups');

$all_users = find_all_user();

if (isset($_POST['add_user'])) {
	$req_fields = array('full-name', 'username', 'password', 'level' );
	validate_fields($req_fields);

	if (empty($errors)) {
		$name   = remove_junk($db->escape($_POST['full-name']));
		$username   = strtolower(remove_junk($db->escape($_POST['username'])));

		foreach ($all_users as $a_user) {
			if ( $username == $a_user['username'] ) {
				//failed
				$session->msg('d', ' Sorry, username already used!');
				redirect('../users/add_user.php', false);
			}
		}

    $password   = remove_junk($db->escape($_POST['password']));
    $confirmpassword = remove_junk($db->escape($_POST['confirmpassword']));
    
    if ($password !== $confirmpassword){
      $session->msg('d', "Passwords are not the same");
			redirect('../users/add_user.php', false);
    }

		$user_level = (int)$db->escape($_POST['level']);
		$password = sha1($password);
		$query = "INSERT INTO users (";
		$query .="name,username,password,user_level,status";
		$query .=") VALUES (";
		$query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
		$query .=")";
		if ($db->query($query)) {
			//sucess
			$session->msg('s', "User account has been created! ");
			redirect('../users/add_user.php', false);
		} else {
			//failed
			$session->msg('d', ' Sorry, failed to create account!');
			redirect('../users/add_user.php', false);
		}
	} else {
		$session->msg("d", $errors);
		redirect('../users/add_user.php', false);
	}
}
?>
<div class="message-text-center">
  <?php echo display_msg($msg); ?>
</div>
  <div class="login-page">
    <div class="text-center">
         <h1>Add New User</h1>
      </div>
          <form method="post" action="../users/add_user.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="full-name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name ="password"  placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" name ="confirmpassword"  placeholder="Confirm Password">
            </div>
            <div class="form-group">
              <label for="level">User Role</label>
                <select class="form-control" name="level">
                  <?php foreach ($groups as $group ):?>
                   <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
            </div>
        </form>
    </div>
  </div>

<?php include_once '../pages/footer.php'; ?>
