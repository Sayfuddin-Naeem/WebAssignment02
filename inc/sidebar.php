<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $category = $db->select($sql);
                if($category) {
                    while($result = $category->fetch_assoc()){
                ?>
                <li><a href="posts.php?catid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>
                    <?php }} else{?>
                <li>No Category Created !!</li>		
                <?php }?>						
            </ul>
    </div>
    
    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php
            $sql = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 3";
            $latesPost = $db->select($sql);
            if ($latesPost) {
                while($result = $latesPost->fetch_assoc()){
        ?>
            <div class="popular clear">
                <h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
                <a href="post.php?id=<?php echo $result['id'];?>"><img src="<?php echo SUBSTR($result['image'],3);?>" alt="post image"/></a>
                <p><?php echo $fmt->textShortener($result['body'],125);?></p>	
            </div>
        <?php }} else{ header("Location:404.php");} ?>
    </div>
    
</div>