<?php
class MysqlStringEscaper
{
    function __get($value)
    {
        return mysql_real_escape_string($value);
    }
}

function SeriesDate($date)
{

	$explodedate = explode("-",$date);
	if($explodedate[0] == "0000" || $explodedate[1] == "00" || $explodedate[2] == "00")
	{
		return "?";
	}
	else
	{
		$month = ($explodedate[1] < 10 ? str_replace("0","",$explodedate[1]) : $explodedate[1]);
		$daara = array("","January","Feburary","March","April","May","June","July","August","September","October","November","December");
		return $daara[$month] . " " . $explodedate[2] . ", " . $explodedate[0];
	}
}

function wrapper($str)
{
	$patterns = array('/\[Written by.*\]/', '/\(Source:.*\)/');
	$str2 = preg_replace($patterns,"",$str);
	return wordwrap($str2,60,'<br />');
}

function getPic($url,$ID)
{
	$img = './aniPic/' . $ID . '.jpg';
	if(!file_exists($img))
		file_put_contents($img, file_get_contents($url));
}

function table($table,$sql,&$database)
{
		echo "<table id='$table' >";
		echo "<tr>";
		echo "<th>#</th>";
		echo "<th>Title</th>";
		echo "<th>Watched Status</th>";
		echo "<th>Score</th>";
		echo "<th>Type</th>";
		echo "<th></th>";
		echo "</tr>";

		$database->ssResults("SELECT * FROM Anime WHERE Watched_Status = '". $sql."' ORDER BY Title");
		$inc = 1;

		while($row = $database->fetchArray())
		{

			getPic($row['ImageURL'],$row['ID']);
			echo "<tr>";
			echo "<td>" . $inc ."</td>";
			echo "<td>" . $row['Title'] . ($row['Status'] == "currently airing" ? "    <b class='air'><i><small>airing</small></i></b>":"") . " </td>";
			echo "<td class='center'>" . $row['Watched_Status']."</td>";
			echo "<td class='center'>" . ($row['Score'] == 0 ? '-' : $row['Score'])."</td>";
			echo "<td>" . $row['Type']."</td>";
			echo "<td><div class='arrow'></div></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td colspan=6>";
					echo "<img src='/aniPic/".$row['ID'].".jpg' />";
					echo "<ul>";
						echo "<li><b>ID</b>: " . $row['ID']."</li>";
						echo "<li><b>Rank:</b> " . $row['Rank']."</li>";
						echo "<li><b>Members Score:</b> " . $row['Members_Score']."</li>";
						echo "<li><b>Episodes:</b> " . $row['Episodes']."</li>";
						echo "<li><b>Status:</b> " . $row['Status']."</li>";
						echo "<li><b>Classification:</b> " .$row['Classification']."</li>";
						echo "<li><b>Genre:</b> " .$row['Genre']."</li>";
						echo "<li><b>Series Start Date:</b> " .SeriesDate($row['SeriesStart'])."</li>";
						echo "<li><b>Series End Date:</b> " . SeriesDate($row['SeriesEnd'])."</li>";
						echo "<br>";
						echo "<li><b>Synopsis:</b> <br/>" . wrapper($row['Synopsis']) . "</li>";
					echo "</ul>";
				echo "</td>";
			echo "</tr>";
			$inc++;
		}
		echo "</table>";
}
?>
