<?

	class Error {
	
		function __construct(){
			
			$this->errors 	= array();
			$this->isError 	= FALSE;
			
		}
		
		function addError($message){
			
			array_push($this->errors, $message);
			
			// There is now an error.
			$this->isError = TRUE;
				
		}
		
		function errorCount(){
			
			return count($this->errors);
			
		}
		
		function clearErrors(){
		
			$this->errors 	= array();
			$this->isError 	= FALSE; 
		
		}
		
		function getErrors(){
			
			$this->clearErrors();
			
			return $this->errors;
		
		}
	
	}

?>