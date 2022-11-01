<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="18%">Post Title</th>
							<th width="15%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="12%">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
    $postsql = "SELECT tbl_post.*, tbl_category.name FROM tbl_post
				INNER JOIN tbl_category
				ON tbl_post.cat = tbl_category.id
				ORDER BY tbl_post.title DESC";
	$post = $db->select($postsql);
	if ($post) {
        $cnt = 0;
		while($postresult = $post->fetch_assoc()){
            $cnt++;
?>
						<tr class="odd gradeX">
							<td><?php echo $cnt;?></td>
							<td><a href="editpost.php?editpostid=<?php echo $postresult['id'];?>"><?php echo $postresult['title'];?></a></td>
							<td><?php echo $fmt->textShortener($postresult['body'],50);?></td>
							<td><?php echo $postresult['name'];?></td>
							<td class="center"> <img src="<?php echo $postresult['image'];?>" alt="<?php echo $postresult['title'];?>" height="40px" width="60px"></td>
							<td> <?php echo $postresult['author'];?></td>
							<td> <?php echo $postresult['tags'];?></td>
							<td> <?php echo $fmt->formatDate($postresult['date']);?></td>
							<td><a href="editpost.php?editpostid=<?php echo $postresult['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!');" href="delpost.php?delpostid=<?php echo $postresult['id'];?>">Delete</a></td>
						</tr>
<?php }} else{?>
						<tr>
							<td style="text-align: center;"><span class='error'>No Post Found !!</span></td>
						</tr>
<?php  }?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include "inc/footer.php";?>