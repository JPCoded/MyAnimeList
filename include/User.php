<?php
class User
{
	private $ID;
	private $User_Name;
	private $Watching;
	private $Completed;
	private $OnHold;
	private $PlanToWatch;
	private $DaysWatched;

	function __construct($II,$TT,$EE,$SS,$WW,$SC,$TY)
	{
		$this->ID = $II;
		$this->User_Name = $TT;
		$this->Watching = $EE;
		$this->Completed = $SS;
		$this->OnHold = $WW;
		$this->PlanToWatch = $SC;
		$this->DaysWatched = $TY;
	}

	function createUserInsert()
	{
		return "INSERT INTO User VALUES ($this->ID,'$this->User_Name',$this->Watching,$this->Completed,$this->OnHold,$this->PlanToWatch,$this->DaysWatched) ON DUPLICATE KEY UPDATE Watching=$this->Watching,Completed=$this->Completed,OnHold=$this->OnHold,PlanToWatch=$this->PlanToWatch,DaysWatched=$this->DaysWatched";
	}
}
?>
