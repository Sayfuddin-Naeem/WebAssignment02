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
        <h2>View Message</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<script>window.location = 'inbox.php';</script>";
        
    }
?>
            <form action="viewmsg.php" method="post">
                <table class="form">
<?php
    $selMsgSql = "SELECT * FROM tbl_contact WHERE id = '$msgid'";
	$message = $db->select($selMsgSql);
	if ($message) {
		while($msgResult = $message->fetch_assoc()){
?>

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $msgResult['firstname'].' '.$msgResult['lastname'];?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $msgResult['email'];?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $fmt->formatDate($msgResult['date']);?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="msgtext  msg" rows="15" readonly><?php echo $msgResult['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="OK" />
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