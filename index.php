<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<?php 

require("conf.php");
//require("open.php");

?>


<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page">
	<div id="header">
	
	<a href="index.php?current=home">Home</a>
	<a href="index.php?current=movie">Movies</a>
	<a href="index.php?current=contact">Contact</a>
	
	</div>

	<div id="content">
	
	<?php
	
		if(isset($_GET["current"])){
			
			$current = $_GET["current"] . ".php";
			
		}else{
			
			$current = "home.php";
			
		}
		
		// On vérifie que le fichier éxiste bien
		if(file_exists($current)){
		
			require($current);
		
		}else{
			
			//require(GAME::config("404-PAGE"));
			//require("home.php");
			
		}
		
		?>

	</div>

	
	<div id="footer"> Footer</div>
</div>

</body>
</html>
