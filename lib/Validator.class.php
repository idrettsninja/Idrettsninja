<?
	
	class Validator{
		
		function __construct() {}
		
		static function validateAccess($target_level){
		
			if((int) session::get('user_access') < $target_level){
				return FALSE;
			}
			
			return TRUE;
			
		}
	
	}