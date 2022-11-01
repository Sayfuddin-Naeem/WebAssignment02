<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
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
            $pageSql = "INSERT INTO tbl_page(name,body) 
            VALUES('$name','$body')";
            $addpage = $db->insert($pageSql);
            if($addpage){
                echo "<span class='success'>Page Created Successfully !!.</span>";
            }else{
                echo "<span class='error'>Page Not Created !!.</span>";
            }
        }
    }
?>
            <form action="addpage.php" method="post">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter Page Name..." class="medium" />
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
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
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