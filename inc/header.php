<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
	$db = new Database();
	$fmt = new Format();
?>
<!DOCTYPE html>
<html>
<head>
<?php
	if (isset($_GET['pageid'])) {
		$pagetitleid = $_GET['pageid'];
		$sqlpagetitle = "SELECT * FROM tbl_page WHERE id = '$pagetitleid'";
		$title = $db->select($sqlpagetitle);
		if($title){
			while($titleResult = $title->fetch_assoc()){
?>
	<title><?php echo $titleResult['name']." - ".TITLE;?></title>

<?php }}}elseif (isset($_GET['id'])) {
		$postTitleid = $_GET['id'];
		$sqlPosttitle = "SELECT * FROM tbl_post WHERE id = '$postTitleid'";
		$posttitle = $db->select($sqlPosttitle);
		if($posttitle){
			while($posttitleResult = $posttitle->fetch_assoc()){
?>
	<title><?php echo $posttitleResult['title']." - ".TITLE;?></title>

<?php }}}else{?>

	<title><?php echo $fmt->title()." - ".TITLE;?></title>

<?php }?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about historical place">
<?php
	if(isset($_GET['id'])){
		$keywordId = $_GET['id'];
		$sqlKeywords = "SELECT * FROM tbl_post WHERE id = '$keywordId'";
		$keywords = $db->select($sqlKeywords);
		if($keywords){
			while($keyResult = $keywords->fetch_assoc()){
?>
	<meta name="keywords" content="<?php echo $keyResult['tags'];?>">
<?php }}}else{?>
	<meta name="keywords" content="<?php echo KEYWORDS;?>">
<?php }?>
	<meta name="author" content="Sayfuddin">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
<?php 
    $sqlslogan = "SELECT * FROM tbl_slogan WHERE id = '1'";
    $sloganLogo = $db->select($sqlslogan);
    if($sloganLogo){
        while($sloganResult = $sloganLogo->fetch_assoc()){
?>
				<img src="<?php echo SUBSTR($sloganResult['logo'],3); ?>" alt="Logo"/>
				<h2><?php echo $sloganResult['title']; ?></h2>
				<p><?php echo $sloganResult['slogan']; ?></p>
<?php }}?>				
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
<?php 
    $sqlsocaial = "SELECT * FROM tbl_social WHERE id = '1'";
    $socialmedia = $db->select($sqlsocaial);
    if($socialmedia){
        while($socialResult = $socialmedia->fetch_assoc()){
?>
				<a href="<?php echo $socialResult['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $socialResult['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $socialResult['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $socialResult['ggp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
<?php }}?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
<?php
	$path = $_SERVER['SCRIPT_FILENAME'];
	$curPage = basename($path, '.php');
	$activated = '';
	if($curPage == 'index'){
		$activated = 'id="active"';
	}
?>
		<li><a <?php echo $activated;?> href="index.php">Home</a></li>
<?php 
    $sqlpage = "SELECT * FROM tbl_page";
    $pages = $db->select($sqlpage);
    if($pages){
        while($pageResult = $pages->fetch_assoc()){
			$activated = '';
			if(isset($_GET['pageid']) && $_GET['pageid'] == $pageResult['id']){
				$activated = 'id="active"';
			}
?>
                        <li><a <?php echo $activated;?> href="page.php?pageid=<?php echo $pageResult['id'];?>"><?php echo $pageResult['name'];?></a></li>
<?php }}
	$activated = '';
	if($curPage == 'contact'){
		$activated = 'id="active"';
	}
?>
		<li><a <?php echo $activated;?> href="contact.php">Contact</a></li>
	</ul>
</div>
