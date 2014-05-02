<?php
require 'include/malfun.php';
require 'include/MySQLDB.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>CWarlord87's Anime List</title>
	<link rel='stylesheet' type='text/css' href='css/MyAnimeList.css' />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
	<script src="jExpand.js" type="text/javascript"></script>
</head>
<body>
    <h1>My Anime List</h1>
    <br/>
    <h3>Watching</h3>
    <?php
       $database = new MySQLDB();
       table("watching","Watching",$database);
       echo "<br/>";
       echo "<h3>Completed</h3>";
       table("completed","Completed",$database);
	   echo "<br/>";
       echo "<h3>On-Hold</h3>";
       table("onhold","On-hold",$database);
       echo "<br/>";
       echo "<h3>Plan To Watch</h3>";
       table("ptw","Plan To Watch",$database);

       $database->close();
       ?>
</body>
</html>
