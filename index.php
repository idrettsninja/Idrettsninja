<?
	function __autoload($class_name) {
	    include 'lib/' . $class_name . '.class.php';
	}	
?>

<?

	// $event = new Event;
	
	$attr	= array('id' => 4, 'title' => 'Dette er tittelen',
			   'body' => 'Dette er texten',
			   'header' => 'test',
			   'greatoe' => 'hehe');
			   

	
	
	
	// print $event->delete($attr);
	
	// $event->findBy(array('id' => 1));

?>

<?

	$event = new Event(array('id' => 1));
	
	$data = $event->findBy(array('id' => 1));
	
#	$event->update($data);
	
	print "<br /><br />";	
	
	print $event->create($data);
	
	print "<br /><br />";
	

	
	
?>