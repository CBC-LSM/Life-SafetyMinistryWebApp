<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type ="image/png" href="/images/cbcfavicon.PNG">
		
		<!-- <meta name="viewport" content="width=1280, initial-scale=1"> -->
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title><?=$pageName?></title>

    <link rel="stylesheet" href="/main.css" />
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../scripts/modal.js"></script>
        
	</head>
<?php 
$user['id']=$_SESSION['user_id'];
$userFind = find_user($user['id'])[0];
$user['name']=$userFind['name'];
$user['username']=$userFind['username'];
$user['status']=$userFind['status'];
$user['group_name']=$userFind['group_name'];

if ($user['status'] == 1){
  $status = "Active";
  }
  else{
      $status = "Not Active";
  }

$group_names = find_all_groups();

?>

	<body style="background-color:#1E1E1E">
  <div class="MainContainer">
    <table class="header_table">
      <tbody>
      <tr>
        <td></td>
        <td><a href="/" target="_self"><img src="/images/LSM_weblogo.png" alt=""/></a></td>
        <td>
        <div class="dropdown"><?=$_SESSION['username'];?>
          <button class="dropbtn"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
          <div class="dropdown-content">
            <a href="/" target="_self">Home</a>
            <a href="/pages/rover.php" target="_self">Rover Checklist</a>
            

            <?php if ($session->isUserLoggedIn()):?> 
              <button type="button" class="astext" id ="edit" title="Edit Password" data-toggle="modal" data-target="#edit_password_modal<?=$user['id'];?>" >Edit Password</button>
              <button type="button" class="astext" id ="edit" title="Edit Account" data-toggle="modal" data-target="#edit_user_modal<?=$user['id'];?>" >Edit Account</button>
              <?php if ($_SESSION['userLevel']==1):?> 
              <a href="/users/add_user.php" target="_self">Add User</a>
              <a href="/users/users.php" target="_self">Users</a>
            <?php endif;?>
            <a href="/users/logout.php" target="_self">Logout</a>
            <?php else:?>
              <a href="/users/index.php" target="_self">Login</a>      
            <?php endif;?>
            
          </div>
        </div>
        </td>
      </tr>
      </tbody>
    </table>
    <?php include '../users/edit_user_modal.php'; ?>
    <?php include '../users/edit_password_modal.php'; ?>