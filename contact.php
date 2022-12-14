<?php include 'inc/header.php';?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $fmt->validation($_POST['firstname']);
        $lname = $fmt->validation($_POST['lastname']);
        $email = $fmt->validation($_POST['email']);
        $body  = $fmt->validation($_POST['body']);
        $fname = mysqli_real_escape_string($db->link,$fname);
        $lname = mysqli_real_escape_string($db->link,$lname);
        $email = mysqli_real_escape_string($db->link,$email);
        $body  = mysqli_real_escape_string($db->link,$body);

		$error = "";
		$msg = "";
		if(empty($fname)){
			$error = "First name must not be empty !";
		}
		elseif(empty($lname)){
			$error = "Last name must not be empty !";
		}
		elseif(empty($email)){
			$error = "Email field must not be empty !";
		}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Invalid Email Address !";
		}
		elseif(empty($body)){
			$error = "Message field must not be empty !";
		}else{
			$contactSql = "INSERT INTO tbl_contact(firstname,lastname,email,body) 
            VALUES('$fname','$lname','$email','$body')";
            $contacT = $db->insert($contactSql);
            if($contacT){
                $msg = "Message Sent Successfully !";
            }else{
                $error = "Message Not Sent !";
            }
        
		}
    }
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
<?php
	if (isset($error)) {
		echo "<span class='error'>$error</span>";
	}elseif(isset($msg)){
		echo "<span class='success'>$msg</span>";
	}
?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
						<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
						<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
						<input type="text" name="email" placeholder="Enter Email Address"/>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send"/>
						</td>
					</tr>
				</table>
			<form>				
		</div>

	</div>
	<?php include 'inc/sidebar.php';?>
</div>

<?php include 'inc/footer.php';?>