<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">
<?php
    if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];
		$statusSql = "UPDATE tbl_contact
						SET
						status = '1'
						WHERE id = '$seenid'";
        $statusUp = $db->update($statusSql);
        if($statusUp){
            echo "<span class='success'>Message Sent in the Seen Box !!.</span>";
        }else{
            echo "<span class='error'>Message Not Sent in the Seen Box !!.</span>";
        }
    }
?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
    $MsgInSql = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
	$MsgInbox = $db->select($MsgInSql);
	if ($MsgInbox) {
        $cnt = 0;
		while($inboxResult = $MsgInbox->fetch_assoc()){
            $cnt++;
?>
						<tr class="odd gradeX">
							<td><?php echo $cnt;?></td>
							<td><?php echo $inboxResult['firstname'].' '.$inboxResult['lastname'];?></td>
							<td><?php echo $inboxResult['email'];?></td>
							<td><?php echo $fmt->textShortener($inboxResult['body'],30);?></td>
							<td><?php echo $fmt->formatDate($inboxResult['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $inboxResult['id'];?>">View</a> ||
								<a href="replymsg.php?msgid=<?php echo $inboxResult['id'];?>">Reply</a> ||
								<a onclick="return confirm('Are you sure to Move the Msg !');" href="?seenid=<?php echo $inboxResult['id'];?>">Seen</a>
							</td>
						</tr>
<?php }} else{?>
                    <tr>
                        <td style="text-align: center;"><span class='error'>No Message Found !!</span></td>
                    </tr>
<?php  }?>
					</tbody>
				</table>
               </div>
            </div>
			<div class="box round first grid">
                <h2>Seen Message</h2>
<?php
	if(isset($_GET['unseenid'])){
		$unseenid = $_GET['unseenid'];
		$statusSql = "UPDATE tbl_contact
						SET
						status = '0'
						WHERE id = '$unseenid'";
        $statusUp = $db->update($statusSql);
		if($statusUp){
            echo "<span class='success'>Message Sent in the Inbox !!.</span>";
        }else{
            echo "<span class='error'>Message Not Sent in the Inbox !!.</span>";
        }
    }
    if(isset($_GET['delmsgid'])){
		$delmsgid = $_GET['delmsgid'];
		$delMsgSql = "DELETE FROM tbl_contact WHERE id = '$delmsgid'";
        $delMsg = $db->delete($delMsgSql);
        if($delMsg){
            echo "<span class='success'>Message Deleted Successfully !!.</span>";
        }else{
            echo "<span class='error'>Message Not Deleted !!.</span>";
        }
    }
?>
                <div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
    $MsgSeenSql = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
	$SeenBoxMsg = $db->select($MsgSeenSql);
	if ($SeenBoxMsg) {
        $cnt = 0;
		while($SeenBoxResult = $SeenBoxMsg->fetch_assoc()){
            $cnt++;
?>
						<tr class="odd gradeX">
							<td><?php echo $cnt;?></td>
							<td><?php echo $SeenBoxResult['firstname'].' '.$SeenBoxResult['lastname'];?></td>
							<td><?php echo $SeenBoxResult['email'];?></td>
							<td><?php echo $fmt->textShortener($SeenBoxResult['body'],30);?></td>
							<td><?php echo $fmt->formatDate($SeenBoxResult['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $SeenBoxResult['id'];?>">View</a> ||
								<a onclick="return confirm('Are you sure to Move the Msg !');" href="?unseenid=<?php echo $SeenBoxResult['id'];?>">Unseen</a> ||
								<a onclick="return confirm('Are you sure to Delete the Msg !');" href="?delmsgid=<?php echo $SeenBoxResult['id'];?>">Delete</a>
							</td>
						</tr>
<?php }} else{?>
                    <tr>
                        <td style="text-align: center;"><span class='warning'>No Message Found !!</span></td>
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