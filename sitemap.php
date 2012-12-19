<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ETIPS - Products for your iPhone and iPod Touch.</title>
<link rel="shortcut icon" href="imagenes/favicon.ico" >
<link rel="apple-touch-icon" href="imagenes/apple-touch-icon.png" >
<link rel="stylesheet" type="text/css" href="estilo.css"/>
<link rel="stylesheet" type="text/css" media="all" href="styles/demoStyles.css" />
<link rel="stylesheet" type="text/css" media="all" href="styles/jScrollPane.css" />
<script type="text/javascript" src="scripts/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
<script type="text/javascript" src="scripts/jScrollPane.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<style>
		#scroll {
				height: 300px;
				width: 360px;
				margin: 5px;
				background-color:transparent;
			}
</style>
		<script type="text/javascript">
			$(function()
			{
				$('#scroll').jScrollPane();
			});			
		</script>
</head>

<body>

<div class="content">

	<div class="header">
    <img src="imagenes/header_logo.jpg" width="808" height="54" />
    <img src="imagenes/header_linea.jpg" width="808" height="4" />
    </div>

	<div class="menu">
    	<?php $menuhome = 1; include("menu.php"); ?>
	</div>

	<div class="home">
		<div class="top"></div>
		<div class="left"></div>
		<div class="middle">  
			<h2><?php echo getTextFor('sitemap_title'); ?></h2>
			<div id="scroll" class="scroll-pane">           
				<div class="sitemap">
					<ul>
						<li><a href="index.php"><?php echo getTextFor('home_title'); ?></a></li>
						<li><a href="locations.php"><?php echo getTextFor('locations_title'); ?></a></li>
						<li><a href="travel_guides.php"><?php echo getTextFor('travelguides_title'); ?></a></li>
						<li><a href="photo_guides.php"><?php echo getTextFor('photoguides_title'); ?></a></li>
						<li><a href="contact.php"><?php echo getTextFor('contact_title'); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
        <div class="right"></div>
        <div class="bottom"></div>
	</div>
    
    <div class="footer">
    <?php include("footer.php"); ?>    
    </div>    
    
</div>

</body>
</html>