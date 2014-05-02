<?php
class Anime
{
	private $ID;
	private $Title;
	private $Episodes;
	private $Status;
	private $Watched;
	private $Score;
	private $Type;
	private $Image;
	private $Classification;
	private $Members;
	private $Rank;
	private $Genre;
	private $SDate;
	private $EDate; 
	private $Synopsis;
	
	function __construct($II,$TT,$EE,$SS,$WW,$SC,$TY,$IM,$CL,$MM,$RA,$GE,$SD,$ED,$SY)
	{
		$this->ID = $II;
		$this->Title = $TT;
		$this->Episodes = $EE;
		$this->Status = $SS;
		$this->Watched = $WW;
		$this->Score = $SC;
		$this->Type = $TY;
		$this->Image = $IM;
		$this->Classification = $CL;
		$this->Members = $MM;
		$this->Rank = $RA;
		$this->Genre = $GE;
		$this->SDate = $SD;
		$this->EDate = $ED;
		$this->Synopsis = $SY;
		
	}

	function createAnimeInsert()
	{
		return "INSERT INTO Anime VALUES ($this->ID,'$this->Title',$this->Episodes,'$this->Status','$this->Watched',$this->Score,'$this->Type','$this->Image','$this->Classification',$this->Members,$this->Rank,'$this->Genre','$this->SDate','$this->EDate','$this->Synopsis') ON DUPLICATE KEY UPDATE Episodes=$this->Episodes, Status='$this->Status', Watched_Status='$this->Watched', Score=$this->Score, Classification='$this->Classification',Members_Score=$this->Members, Rank=$this->Rank,Genre='$this->Genre',SeriesStart='$this->SDate',SeriesEnd='$this->EDate',Synopsis='$this->Synopsis'";
	}
}
?>
