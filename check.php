<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
	$db = new Database();
	$fmt = new Format();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Check</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "./postimage/".$unique_image;

            if($file_temp == ""){
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
                $query = "INSERT INTO tbl_image(image) 
                VALUES('$uploaded_image')";
                
                $addpost = $db->insert($query);
                if($addpost){
                    echo "<span class='success'>Post Inserted Successfully !!.</span>";
                }else{
                    echo "<span class='error'>Post Not Inserted !!.</span>";
                }
            }
        }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
         <h2>upload an image</h2>
        <input type="file" name="image" id="">
        <input type="submit" value="UPLOAD">
    </form>
</body>
</html>