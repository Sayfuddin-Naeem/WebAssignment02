<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
<?php 
    $sqlfooter = "SELECT * FROM tbl_footer WHERE id = '1'";
    $footer = $db->select($sqlfooter);
    if($footer){
        while($footerResult = $footer->fetch_assoc()){
?>
	  <p>&copy; <?php echo $footerResult['note'];?> <?php echo date('Y');?></p>
<?php }}?>
	</div>
	<div class="fixedicon clear">
<?php 
    $sqlsocaial = "SELECT * FROM tbl_social WHERE id = '1'";
    $socialmedia = $db->select($sqlsocaial);
    if($socialmedia){
        while($socialResult = $socialmedia->fetch_assoc()){
?>
		<a href="<?php echo $socialResult['fb']; ?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $socialResult['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $socialResult['ln']; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $socialResult['ggp']; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>
<?php }}?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>