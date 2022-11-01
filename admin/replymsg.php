<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL){
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Reply Message</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $to      = $fmt->validation($_POST['toEmail']);
        $from    = $fmt->validation($_POST['fromEmail']);
        $subject = $fmt->validation($_POST['subject']);
        $message = $fmt->validation($_POST['message']);
        $to      = mysqli_real_escape_string($db->link,$to);
        $from    = mysqli_real_escape_string($db->link,$from);
        $subject = mysqli_real_escape_string($db->link,$subject);
        $message = mysqli_real_escape_string($db->link,$message);

        $sendMail = mail($to, $subject, $message, $from);
        if($sendMail){
            echo "<span class='success'>Message Sent Successfully !!.</span>";
        }else{
                echo "<span class='error'>Message Not Sent !!.</span>";
            }
        
    }
?>
            <form action="replymsg.php" method="post">
                <table class="form">
<?php
    $selMsgSql = "SELECT * FROM tbl_contact WHERE id = '$msgid'";
	$message = $db->select($selMsgSql);
	if ($message) {
		while($msgResult = $message->fetch_assoc()){
?>
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" name="toEmail" value="<?php echo $msgResult['email'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromEmail" placeholder="Please Enter your Email Address" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                        <input type="text" name="subject" placeholder="Please Enter Subject" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="message" rows="15" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
                        </td>
                    </tr>
<?php }} ?>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>