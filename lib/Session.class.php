<?
	class Session{
		
		function __construct() {}
		
		static function init(){
			
			@session_start();
			
		}
		
		static function set($key, $value){
		
			$_SESSION[$key] = $value;
		
		}
		
		static function get($key) {
			
			return $_SESSION[$key];
			
		}
		
		static function destroy() {
			
			session_unset();
			session_destroy();
			
		}
	
	}