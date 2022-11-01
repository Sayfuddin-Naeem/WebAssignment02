<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    if(!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL){
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['editpostid'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
        $cat = $fmt->validation($cat);
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $title = $fmt->validation($title);
        $body = mysqli_real_escape_string($db->link,$_POST['body']);
        $author = mysqli_real_escape_string($db->link,$_POST['author']);
        $author = $fmt->validation($author);
        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
        $tags = $fmt->validation($tags);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/post/".$unique_image;

        if($cat == "" || $title == "" || $body == "" || $author == "" || $tags == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        else{
            if(!empty($file_name)){
                if ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } 
                elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } 
                else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_post
                                SET
                                cat   = '$cat',
                                title = '$title',
                                body  = '$body',
                                image = '$uploaded_image',
                                author= '$author',
                                tags  = '$tags'
                                WHERE id = '$postid'";
                    $postupdate = $db->update($query);
                    if($postupdate){
                        echo "<span class='success'>Post Updated Successfully !!.</span>";
                    }else{
                        echo "<span class='error'>Post Not Updated !!.</span>";
                    }
                }
            } else{
                $query = "UPDATE tbl_post
                            SET 
                            cat   = '$cat', 
                            title = '$title', 
                            body  = '$body', 
                            author= '$author', 
                            tags  = '$tags'
                            WHERE id = '$postid'";
                $postupdate = $db->update($query);
                if($postupdate){
                    echo "<span class='success'>Post Updated Successfully !!.</span>";
                }else{
                    echo "<span class='error'>Post Not Updated !!.</span>";
                }
            
            }
        }
        
            
        
    }
?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">
<?php
    $query = "SELECT * FROM tbl_post WHERE id = '$postid'";
    $editpost = $db->select($query);
    if ($editpost) {
        $editresult = $editpost->fetch_assoc();
?> 

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $editresult['title'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option>Select Category</option>
<?php
    $sql = "SELECT * FROM tbl_category ORDER BY id DESC";
	$category = $db->select($sql);
	if ($category) {
		while($result = $category->fetch_assoc()){
            $selection = "";
            if($editresult['cat'] == $result['id']){
                $selection = "selected";
            }
?>
                                <option value="<?php echo $result['id'];?>" <?php echo $selection;?>><?php echo $result['name'];?></option>

<?php }}?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                        <td style="align-content: right;"><img src="<?php echo $editresult['image'];?>" alt="<?php echo $editresult['title'];?>" height="200px" width="350px"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body" ><?php echo $editresult['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $editresult['author'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $editresult['tags'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
<?php } else{ ?>                            
                    <tr>
                        <td style="text-align: center;">
                            <p class="error">The Post Not Found !! <br> Please try Again.</p>
                        </td>
                    </tr>
<?php }?>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>