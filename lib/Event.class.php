<?
	require 'AppSupport.php';

	class Event extends AppSupport{
		
		const table_name 	= 'events';	
		const default_col	= 'id';
	
		function Event($param=NULL){
			
			parent::__construct();
			
			$this->connect();

			if($param != NULL):
			
				$this->findBy($param);
			
			endif;
			
		}
		
		function create($param){
		
			session::set('user_access', 1); // For demonstrational purposes.
			
			if(validator::validateAccess(1)):
				
				$query = $this->constructQuery($param);
				
				if(mysql_query($query)):
					return TRUE;
				else:
					$this->error->addError('Could not perform MySQL Query');
				endif;
			
			else:
				
				$this->error->addError('The user does not have the required access or is not logged in.');
				$this->redirect('home');
				
			endif;
			
		}
		
		function update($param, $specific=NULL){
			
			print $query = $this->constructQuery($param, $specific);		
			
		}
		
		function delete($param, $specific=NULL){
			
			print $query = $this->constructQuery($param, $specific);		
			
		}
		
	}

?>