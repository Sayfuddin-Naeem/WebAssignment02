<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
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

        if($cat == "" || $title == "" || $body == "" || $file_name == "" || $author == "" || $tags == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } 
        elseif (in_array($file_ext, $permited) === false) {
        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } 
        else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_post(cat,title,body,image,author,tags) 
            VALUES('$cat','$title','$body','$uploaded_image','$author','$tags')";
            $addpost = $db->insert($query);
            if($addpost){
                echo "<span class='success'>Post Inserted Successfully !!.</span>";
            }else{
                echo "<span class='error'>Post Not Inserted !!.</span>";
            }
        }
    }
?>
            <form action="addpost.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
?>
                                <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>

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
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" placeholder="Enter Author Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>