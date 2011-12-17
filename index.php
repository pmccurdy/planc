<?php

session_start();
require("conf.php");
require("open.php");

if (array_key_exists('user', $_GET)) {
    $_SESSION['user'] = intval($_GET['user']);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page">
	<div id="header">

	<a href="index.php?current=home">Home</a>
	<a href="index.php?current=movies">Movies</a>
	<a href="index.php?current=contact">Contact</a>
	</div>

	<div id="content">

	<?php

		if(isset($_GET["current"])){

			$current = $_GET["current"] . ".php";

		}else{

			$current = "home.php";

		}

		// On v�rifie que le fichier �xiste bien
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
