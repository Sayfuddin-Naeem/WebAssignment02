<div class="slidersection templete clear">
    <div id="slider">
    <?php
	$sql = "SELECT id,title, image FROM tbl_post";
	$post = $db->select($sql);
	if ($post) {
		while($result = $post->fetch_assoc()){
    ?>
        <a href="post.php?id=<?php echo $result['id'];?>"><img src="<?php echo SUBSTR($result['image'],3);?>" alt="<?php echo $result['title'];?>" title="<?php echo $result['title'];?>" /></a>
        <?php }} else{ echo "<p>Slide Image Not Found !!";} ?>
    </div>

</div>
