<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link,$name);
        $name = $fmt->validation($name);
        if(empty($name)){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }else{
            $query = "INSERT INTO tbl_category(name) VALUES('$name')";
            $catinsert = $db->insert($query);
            if($catinsert){
                echo "<span class='success'>Category Created Successfully !!.</span>";
            }else{
                echo "<span class='error'>Category Not Created !!.</span>";
            }
        }
        
        
    }
?>
                 <form action="addcat.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
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