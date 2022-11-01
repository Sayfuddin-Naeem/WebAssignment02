<?php include 'inc/header.php';?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
<!-- Search -->	
<?php
	if(!isset($_GET['search']) || $_GET['search'] == NULL){
		header("Location:404.php");
	}else{
        $search = $_GET['search'];
    }
?>
<!-- Search -->	
<?php
	$sql = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%' OR tags LIKE '%$search%'";
	$posts = $db->select($sql);
	if ($posts) {
		while($result = $posts->fetch_assoc()){
?>

	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
		<h4><?php echo $fmt->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
		<a href="post.php?id=<?php echo $result['id'];?>"><img src="<?php echo $result['image'];?>" alt="post image"/></a>
		<p>
			<?php echo $fmt->textShortener($result['body']);?>
		</p>
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
		</div>
	</div>
<?php }?>  <! --End while loop -->

<?php } else{ echo "<p>YOUR SEARCH QUERY NOT FOUND !!</p>";} ?>			

		</div>
		<?php include 'inc/sidebar.php';?>

	</div>

	<?php include 'inc/footer.php';?>