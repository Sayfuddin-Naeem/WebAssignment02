<?php 
	include '../lib/Session.php';
	Session::checkSession();
?> 
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
	$db = new Database();
?>

<?php
    if(!isset($_GET['deluserid']) || $_GET['deluserid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $deluserid = $_GET['deluserid'];

        $delsql = "DELETE FROM tbl_user WHERE id = '$deluserid'";
        $delUserdata = $db->delete($delsql);

        if($delUserdata){
            echo "<script>alert('User Deleted Successfully !!');</script>";
            echo "<script>window.location = 'userlist.php';</script>";
        }else{
            echo "<script>alert('User Not Deleted !!');</script>";
            echo "<script>window.location = 'userlist.php';</script>";
        }
    }
?>