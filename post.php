<?php include 'inc/header.php';?>
<?php 
	if(!isset($_GET['id']) || $_GET['id'] == NULL){
		header("Location:404.php");
	}
	else{
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
	<?php
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_post WHERE id = $id";
		$post = $db->select($sql);
		if ($post) {
			$result = $post->fetch_assoc();
	?>
		<div class="about">
			<h2><?php echo $result['title'];?></h2>
			<h4><?php echo $fmt->formatDate($result['date']);?>, By <?php echo $result['author'];?></h4>
			<img src="<?php echo SUBSTR($result['image'],3);?>" alt="MyImage"/>
			<p><?php echo $result['body'];?></p>		
			<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php
					$catId = $result['cat'];
					$sql = "SELECT * FROM tbl_post WHERE cat = $catId ORDER BY RAND() LIMIT 6";
					$relatedPost = $db->select($sql);
					if ($relatedPost) {
						while($relatedResult = $relatedPost->fetch_assoc()){
							if($relatedResult['id'] != $id){
				?>	
				
					
				<a href="post.php?id=<?php echo $relatedResult['id'];?>"><img src="<?php echo SUBSTR($relatedResult['image'],3); ?>" alt="post image"/></a>

					<?php }}?>  <! --End while loop -->		
				<?php } else{ echo "Related Post Not Available !!\n";} ?>
			</div>
		</div>
		<?php } else{ header("Location:404.php");}
}?>

	</div>
	<?php include 'inc/sidebar.php';?>
</div>

<?php include 'inc/footer.php';?>