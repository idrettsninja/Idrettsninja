<?
	require 'config/db.php';
	
	class AppSupport {
	
		function __construct() {
		
			$this->error = new Error;
			
		}
	
		function connect(){
					
			mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
			
			mysql_select_db(DB_NAME);
			
		}
		
		// Query Generator
		
		function paramToAttr($param){
			
			$i		= 1;
			$str	= "(";
			
			foreach($param as $key => $value):
			
				if($i < count($param)){
					$str .= $key . ", ";
					$i++;
				} else{
					$str .= $key;
				}
			
			endforeach;
			
			$str .= ")";
			
			return $str;
		
		}
		
		function paramToValues($param){
		
			$i		= 1;
			$str	= "(";
			
			foreach($param as $value):
			
				if($i < count($param)){
					$str .= "'$value'" . ", ";
					$i++;
				} else{
					$str .= "'$value'";
				}
			
			endforeach;
			
			$str .= ")";
			
			return $str;
		
		}
		
		function paramToKeyValuePairs($param){
			
			$i		= 1;
			$str	= "";
			
			foreach($param as $key => $value):
			
				if($i < count($param)){
					$str .= "$key='$value'" . ", ";
					$i++;
				} else{
					$str .= "$key='$value'";
				}
				
			endforeach;
			
			return $str;
		
		}

		
		function getCalledFunction(){
			
			$e = new Exception;
			$trace = $e->getTrace();
							
			return $trace[2]['function'];
			
		}
		
		function constructQuery($param, $specific=NULL){
			
			$class  = get_called_class();
			$action = $this->getCalledFunction();
			
			switch($action):
			
				case 'create':
					$attr 	= $this->paramToAttr($param);
					$values	= $this->paramToValues($param);
					
					$query 	= 'INSERT INTO ' . $class::table_name . ' ' . $attr . ' VALUES ' . $values;
					
					return $query;
					
				break;
				
				case 'update':
					$keyValuePairs = $this->paramToKeyValuePairs($param);
					
					if($specific != NULL):
						$query 	= 'UPDATE ' . $class::table_name . ' SET ' . $keyValuePairs . ' WHERE ' . $specific;
					elseif($param['id']):
						$query 	= 'UPDATE ' . $class::table_name . ' SET ' . $keyValuePairs . " WHERE id='$param[id]'";
					else:
						print "Some UPDATE error here!!"; // NEEDS TO BE CHANGED
					endif;
					
					return $query;
					
				break;
				
				case 'delete':
					
					if($specific != NULL):
						$query = 'DELETE FROM ' . $class::table_name . ' WHERE ' . $specific;
					elseif($param['id']):
						$query = 'DELETE FROM ' . $class::table_name . " WHERE id='$param[id]'";
					else:
						print "Some DELETE error here!!"; // NEEDS TO BE CHANGED
					endif;
					
					return $query;
					
				break;
				
					
			
			endswitch;
			
		}
		
		// Dynamic Find Methods
		
		function findBy($param){
		
			$class  = get_called_class();
			
			if(!is_array($param)):
			
				$query = mysql_query("SELECT * FROM " . $class::table_name . " WHERE " . $this::default_col . " ='" . $param . "'");
				
				$data = mysql_fetch_assoc($query);
				
				return $data;
				
			elseif(is_array($param)):
			
				$query = mysql_query("SELECT * FROM " . $class::table_name . " WHERE " . key($param) . " ='" . $param[key($param)] . "'");	
				
				$data = mysql_fetch_assoc($query);
				
				return $data;
				
			endif;
		
		}
		
		function findAll($param){

			$class  = get_called_class();
			$array  = array();
			
			if(!is_array($param)):
			
				$query = mysql_query("SELECT * FROM " . $class::table_name . " WHERE " . $this::default_col . " ='" . $param . "'");
				
				while($data = mysql_fetch_assoc($query)):
					
					array_push($array, $data);
					
				endwhile;
				
				return $array;
				
			elseif(is_array($param)):
			
				$query = mysql_query("SELECT * FROM " . $class::table_name . " WHERE " . key($param) . " ='" . $param[key($param)] . "'");	
				
				while($data = mysql_fetch_assoc($query)):
					
					array_push($array, $data);
					
				endwhile;
				
				return $array;
				
			endif;
		
		}
		
				
		// Helper methods
		
		function redirect($url){
		
			print '<meta http-equiv="refresh" content="2;url=' . $url . '">';
		
		}
		
	
	}
	
	
	


?>