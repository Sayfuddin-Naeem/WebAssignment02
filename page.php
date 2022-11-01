<?php include 'inc/header.php';?>
<?php
    if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
        header("Location:404.php");
    }else{
        $pageid = $_GET['pageid'];
    }
?>
	<div class="contentsection contemplete clear">
<?php
    $pageSelsql = "SELECT * FROM tbl_page WHERE id = '$pageid'";
    $pageSel = $db->select($pageSelsql);
    if($pageSel){
        while($pageSelResult = $pageSel->fetch_assoc()){
?>
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $pageSelResult['name'];?></h2>
				<?php echo $pageSelResult['body'];?>
				
			</div>
		</div>
<?php }} else{ header("Location:404.php");}?>
            <?php include 'inc/sidebar.php';?>
	</div>


<?php include 'inc/footer.php';?>