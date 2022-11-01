<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = mysqli_real_escape_string($db->link,$_POST['username']);
        $password = mysqli_real_escape_string($db->link,$_POST['password']);
        $role = mysqli_real_escape_string($db->link,$_POST['role']);
        $username = $fmt->validation($username);
        $password = md5($fmt->validation($password));
        $role = $fmt->validation($role);

        if(empty($username) || empty($password) || empty($role)){
            echo "<span class='error'>Field must not be empty !!.</span>";
        } else{
            $userInSql = "INSERT INTO tbl_user(username, password, role) VALUES('$username', '$password', '$role')";
            $userIns = $db->insert($userInSql);
            if($userIns){
                echo "<span class='success'>User Created Successfully !!.</span>";
            }else{
                echo "<span class='error'>User Not Created !!.</span>";
            }
        }
    }
?>
                 <form action="adduser.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label for="username">Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="role">User Role</label>
                            </td>
                            <td>
                                <select name="role" id="select">
                                    <option>Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
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