<?php
include_once("ConnectException.php");
class Connection
{
 	private $servername;
	private $username;
	private $password;
	private $dabasename;
	private $con;
//Construct
	function __construct()
	{
		$this->servername="localhost";
		$this->username="imingcom_arming";
		$this->password="cominter";
		$this->dabasename="imingcom_30goodjobstore";

	}

	function __destruct()
	{
		$this->servername="";
		$this->username="";
		$this->password="";
		$this->dabasename="";
	}
//End Construct

//Operation
	public function Dbconnect()
	{
         $this->con=mysql_connect($this->servername,$this->username,$this->password);
		 if(!$this->con)
			 throw new ConnectException("Connect Fail!!");
	     $objDB = mysql_select_db($this->dabasename);
       return $this->con;
	}
	public function Dbclose()
	{
         $close = mysql_close($this->con);
		 if(!$close)
             throw new Exception("Close Fail!!");
	}
	public function Dbquery($strSQL)
	{
         $result = mysql_query($strSQL);
		 if(!is_resource($result))
             throw new Exception("Execute Fail!!");
		 return $result;
	} 
	public function Dbupdate($strSQL)
	{
         $result = mysql_query($strSQL);
		 if(!$result )
             throw new Exception("Execute Fail!!");
	}	
//End Operation
}
?>