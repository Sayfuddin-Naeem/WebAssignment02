<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>User List</h2>
            <div class="block">        
                <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
    $usrSql = "SELECT * FROM tbl_user ORDER BY id DESC";
	$userData = $db->select($usrSql);
	if ($userData) {
        $cnt = 0;
		while($userResult = $userData->fetch_assoc()){
            $cnt++;
?>
                    <tr class="odd gradeX">
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $userResult['name'];?></td>
                        <td><?php echo $userResult['username'];?></td>
                        <td><?php echo $userResult['email'];?></td>
                        <td><?php echo $fmt->textShortener($userResult['details'], 30);?></td>
                        <td>
                            <?php 
                                if($userResult['role'] == '0'){
                                    echo "Admin";
                                }elseif($userResult['role'] == '1'){
                                    echo "Author";
                                }elseif($userResult['role'] == '2'){
                                    echo "Editor";
                                }
                            ?>
                        </td>
                        <td><a href="viewuser.php?userid=<?php echo $userResult['id'];?>">View</a> || <a onclick="return confirm('Are you sure to Delete User!');" href="deluser.php?deluserid=<?php echo $userResult['id'];?>">Delete</a></td>
                    </tr>
<?php }} else{?>
                    <tr>
                        <td style="text-align: center;"><span class='error'>No User Found !!</span></td>
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