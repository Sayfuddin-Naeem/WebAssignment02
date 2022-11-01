<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
<!-- pagination -->	
<?php
	$per_page = 3;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else{
		$page = 1;
	}
	$startForm = ($page - 1)* $per_page;
?>
<!-- pagination -->	

<?php
	$sql = "SELECT * FROM tbl_post LIMIT $startForm, $per_page";
	$post = $db->select($sql);
	if ($post) {
		while($result = $post->fetch_assoc()){
?>

	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
		<h4><?php echo $fmt->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
		<a href="post.php?id=<?php echo $result['id'];?>"><img src="<?php echo SUBSTR($result['image'],3);?>" alt="post image"/></a>
		<p>
			<?php echo $fmt->textShortener($result['body']);?>
		</p>
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
		</div>
	</div>
<?php }?>  <! --End while loop -->

<!-- pagination -->	
<?php
	$sql = "SELECT * FROM tbl_post";
	$result = $db->select($sql);
	$totalRows = mysqli_num_rows($result);
	$totalPages = ceil($totalRows/$per_page);
	
	echo "<span class='pagination'><a href='index.php?page=1'>"."First Page"."</a>";
	$cnt = 0;
	for ($i=$page; $i <= $totalPages; $i++) { 
		echo "<a href='index.php?page=$i'>$i</a>";
		$cnt++;
		if ($cnt == 5) { break;}
	}
	echo "<a href='index.php?page=$totalPages'>"."Last Page"."</a></span>";
?>

<!-- pagination -->	

<?php } else{ header("Location:404.php");} ?>			

		</div>
		<?php include 'inc/sidebar.php';?>

	</div>

	<?php include 'inc/footer.php';?>