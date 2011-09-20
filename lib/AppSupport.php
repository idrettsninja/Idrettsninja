<?
	
	include("lib/config/db.php");
	
	class AppSupport {
	
		$this->host			= $host;
		$this->db_name		= $db_name;
		$this->username 	= $username;
		$this->password 	= $password;
		
		$this->connected 	= FALSE;
	
		function connect(){
			
			if(!$this->connected()){
				
				mysql_connect($this->host, $this->username, $this->password));
				
				mysql_select_db($this->db_name);
				
				$this->connected = TRUE;
					
			}		
		
		}
		
		// Access Control
		
		function validateAccess($level){
			
			// Supply the required access level; returns true if user passes.
			
			if($_SESSION['user_access'] < $level){
			
			}
				
				 
			
			return TRUE;
			
		}
	
	}
	
	

?>