<?php

require_once("clever-php-master/lib/Clever.php");
Clever::setToken("DEMO_TOKEN");

?>

<?php
	
	$selected_section = CleverSection::retrieve($_GET["q"]);
	$students = $selected_section -> students();
	$student_names = array();	
																								
	foreach ($students as $student) {
		$student_json = json_decode($student,true);
		$student_id = $student_json['student_number'];
		$student_first = $student_json['name']['first'];
		$student_last = $student_json['name']['last'];

		$student_names[] = $student_first . ' ' . $student_last;
	}

	print json_encode(array(
	        "student_names" => $student_names,
	        "anotherReturnValue" => "just a demo how to return more stuff")
	);


?>

