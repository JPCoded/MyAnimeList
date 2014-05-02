<html>
<title>Anime Update</title>
<body>
<?php
require 'include/MySQLDB.php';
require 'include/Anime.php';
require 'include/malfun.php';
require 'include/User.php';
require 'include/ebug.php';


eBug("Loading xml file");
$xml = simplexml_load_file('http://myanimelist.net/malappinfo.php?status=all&u=cwarlord87') or die("Failed to load Anime List xml file<br/>");

eBug("Creating database");
$database = new MySQLDB();

eBug("Creating user insert");
$setUser = new User($xml->myinfo->user_id, $xml->myinfo->user_name, $xml->myinfo->user_watching, $xml->myinfo->user_completed, $xml->myinfo->user_onhold, $xml->myinfo->user_plantowatch, $xml->myinfo->user_days_spent_watching);
$sql = "TRUNCATE TABLE User";
$sql2 = "TRUNCATE TABLE Anime";
$database->addStatement($sql,$sql2,$setUser->createUserInsert());

eBug("Start foreach loop");
foreach($xml->anime as $anime)
{
	$str = new MysqlStringEscaper;
	$url = "http://mal-api.com/anime/". $anime->series_animedb_id."?format=xml";
	$xml2 = simplexml_load_file($url) or die("Failed to get $url<br/>");
	$Wstatus = $anime->my_status;
	$Type = $xml2->type;
	$ID = $anime->series_animedb_id;
	$Episodes = $anime->series_episodes;
	$Title = mysql_real_escape_string($anime->series_title);
	$Synopsis = $xml2->synopsis;
	$MyScore = $anime->my_score;
	$SStatus = $xml2->status;
	$Image = $anime->series_image;
	$Class = $xml2->classification;
	$MScore = $xml2->members_score;
	$Rank = $xml2->rank;
	$Synopsis = $xml2->synopsis;
	$Genre = $anime->my_tags;
	$SDate = $anime->series_start;
	$EDate = $anime->series_end;
	
	switch($Wstatus)
	{
		case '1': $Wstatus = "Watching"; break;
		case '2': $Wstatus = "Completed"; break;
		case '3': $Wstatus = "On-Hold"; break;
		case '4': $Wstatus = "Dropped"; break;
		case '6': $Wstatus = "Plan To Watch"; 
	}

	$setAnime = new Anime($ID,$Title,$Episodes,$SStatus,$Wstatus,$MyScore,$Type,$Image,$Class,$MScore,$Rank,$Genre,$SDate,$EDate,$str->$Synopsis);
	$database->addStatement($setAnime->createAnimeInsert());
}

if($database->transaction())
	eBug("Insert worked.");
else
	eBug(mysql_error($database->getConn()));
	
	$database->close();

?>
</body>
</html>
