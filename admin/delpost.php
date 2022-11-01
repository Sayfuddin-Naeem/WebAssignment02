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
    if(!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL){
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['delpostid'];
        
        /// Delete Image From Folder

        $selImgsql = "SELECT image FROM tbl_post WHERE id = '$postid'";
        $getImg = $db->select($selImgsql);
        if($getImg){
            $data = $getImg->fetch_assoc();
            $delImglink = $data['image'];
            unlink($delImglink);
        }

        $delsql = "DELETE FROM tbl_post WHERE id = '$postid'";
        $delpostdata = $db->delete($delsql);

        if($delpostdata){
            echo "<script>alert('Post Deleted Successfully.');</script>";
            echo "<script>window.location = 'postlist.php';</script>";
        }else{
            echo "<script>alert('Post Not Deleted.');</script>";
            echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>