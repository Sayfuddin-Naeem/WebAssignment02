<?php 
	include '../lib/Session.php';
	Session::checkSession();
?> 
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
	$db = new Database();
	$fmt = new Format();
?>
<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000"); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <?php include "cssJs.php";?>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img style="border-radius:50%;" src="img/Logo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Historical Site</h1>
					<p>www.historicalsiteintheworld.com</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
<?php
    if (isset($_GET['action']) && $_GET['action'] == "logout"){
        Session::destroy();
    }
?>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('username');?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
<?php
    $MsgCntSql = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
	$Msg = $db->select($MsgCntSql);
    if($Msg){
        $MsgCnt = mysqli_num_rows($Msg);
        echo "(".$MsgCnt.")";
    }else{
        echo "(0)";
    }
?>
                </span></a></li>
				<li class="ic-grid-tables"><a href="adduser.php"><span>Add User</span></a></li>
				<li class="ic-grid-tables"><a href="userlist.php"><span>User List</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
