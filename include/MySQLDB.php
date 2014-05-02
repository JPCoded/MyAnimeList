<?php
//Makes a SQL Transaction then loops through an array of sql statements and if one of them produces an error or doesn't affect rows, it will rollback database so nothing is changed, otherwise complete transaction
class MySQLDB
{
	private $connection;          // The MySQL database connection
	private $query = array();
	private $results = NULL;

	/* Class constructor */
	function MySQLDB()
	{
		/* Make connection to database */
		$this->connection = mysql_connect("localhost","USERNAME","PASSWORD") or die('Could not connect: ' . mysql_error());
		mysql_select_db("cwarlord87", $this->connection) or die("Unable to select database: " . mysql_error());
	}
	
	function queryReset()
	{
		$query = array();
	}

	/* Automatically close at end of scope. In case close() isn't called */
	public function close()
	{
		mysql_close( $this->connection );
			
	}

	public function getConn()
	{
		return $this->connection;
	}

	/* Add SQL statement into private query.
	 * Takes any number of statements */
	function addStatement()
	{
		$num_args = func_num_args();
		if($num_args > 0)
		{
			$args = func_get_args();
			$count = count($args);
			for($i=0; $i < $count;$i++)
				array_push($this->query, array("query" => $args[$i]));
		}
	}

	/* Transactions functions */

	function begin()
	{
		echo "Begin Transaction<br/>";
		$null = mysql_query("START TRANSACTION", $this->connection);
		return mysql_query("BEGIN", $this->connection);
	}

	function commit()
	{
		echo "Commit<br/>";
		return mysql_query("COMMIT", $this->connection);
	}

	function rollback()
	{
		echo "Rollback<br/>";
		return mysql_query("ROLLBACK", $this->connection);
	}

	function transaction()
	{
		$retval = true;
		$this->begin();

		foreach($this->query as $qa)
		{
			$result = mysql_query($qa['query'], $this->connection);
			if(!$result)
			{
				echo mysql_error($this->connection) . "<br/>";
				echo "SQL: " . $qa['query'] . "<br/>";
				$retval = false;
			}
		}

		if(!$retval)
		{
			$this->rollback();
			return false;
		}
		else
		{
			$this->commit();
			return true;
		}
	}

	/* OTHER FUNCTIONS */

	/* select statement results*/
	function ssResults($sql)
	{
		$this->results = mysql_query($sql,$this->connection);

		return $this->results;
	}

	/* mysql_fetch_array */
	function fetchArray($sql = NULL)
	{
		if(is_null($sql))
		{
			return mysql_fetch_array($this->results);
		}
		else
		{
			$sqlquery = mysql_query($sql,$this->connection);
			return mysql_fetch_array($sqlquery);
		}
	}

	/* mysql_num_rows */
	function rowsUsed($sql = NULL)
	{
		if(is_null($sql))
		{
			return mysql_num_rows($this->results);
		}
		else
		{
			$rows = mysql_query($sql,$this->connection);
			return mysql_num_rows($rows);
		}
	}
}
?>
