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
    if(!isset($_GET['delpageid']) || $_GET['delpageid'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $pageid = $_GET['delpageid'];

        $delPagesql = "DELETE FROM tbl_page WHERE id = '$pageid'";
        $delPagedata = $db->delete($delPagesql);

        if($delPagedata){
            echo "<script>alert('Page Deleted Successfully.');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }else{
            echo "<script>alert('Page Not Deleted.');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }
    }
?>