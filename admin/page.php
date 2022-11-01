<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
<?php
    if(!isset($_GET['editpageid']) || $_GET['editpageid'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $pageid = $_GET['editpageid'];
    }
?>
    <div class="box round first grid">
        <h2>Edit Page</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = mysqli_real_escape_string($db->link,$_POST['name']);
        $name = $fmt->validation($name);
        $body = mysqli_real_escape_string($db->link,$_POST['body']);

        if($name == "" || $body == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        else{
            $pageUpSql = "UPDATE tbl_page
                            SET
                            name = '$name',
                            body = '$body' 
                            WHERE id = '$pageid'";
            $updatePage = $db->update($pageUpSql);
            if($updatePage){
                echo "<span class='success'>Page Updated Successfully !!.</span>";
            }else{
                echo "<span class='error'>Page Not Updated !!.</span>";
            }
        }
    }
?>
            <form action="" method="post">
                <table class="form">
<?php
    $pageSelsql = "SELECT * FROM tbl_page WHERE id = '$pageid'";
    $pageSel = $db->select($pageSelsql);
    if($pageSel){
        while($pageSelResult = $pageSel->fetch_assoc()){
?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $pageSelResult['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $pageSelResult['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <span class="delaction"><a onclick="return confirm('Are you sure to Delete the Page!');" href="delpage.php?delpageid=<?php echo $pageSelResult['id'];?>">Delete</a></span>
                        </td>
                    </tr>
<?php }}?>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>