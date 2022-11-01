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
    if(!isset($_GET['delcatid']) || $_GET['delcatid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $catid = $_GET['delcatid'];

        $delsql = "DELETE FROM tbl_category WHERE id = '$catid'";
        $delCatdata = $db->delete($delsql);

        if($delCatdata){
            echo "<script>alert('Category Deleted Successfully.');</script>";
            echo "<script>window.location = 'catlist.php';</script>";
        }else{
            echo "<script>alert('Category Not Deleted.');</script>";
            echo "<script>window.location = 'catlist.php';</script>";
        }
    }
?>