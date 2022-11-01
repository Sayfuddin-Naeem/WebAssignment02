<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Category List</h2>
            <div class="block">        
                <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
    $sql = "SELECT * FROM tbl_category ORDER BY id DESC";
	$category = $db->select($sql);
	if ($category) {
        $cnt = 0;
		while($result = $category->fetch_assoc()){
            $cnt++;
?>
                    <tr class="odd gradeX">
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $result['name'];?></td>
                        <td><a href="editcat.php?editcatid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!');" href="delcat.php?delcatid=<?php echo $result['id'];?>">Delete</a></td>
                    </tr>
<?php }} else{?>
                    <tr>
                        <td style="text-align: center;"><span class='error'>No Category Found !!</span></td>
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