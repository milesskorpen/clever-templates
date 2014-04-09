<?php

	require_once("clever-php-master/lib/Clever.php");
	Clever::setToken("DEMO_TOKEN");

	$template = $_POST["template"];
	$teacher = $_POST["teacher"];
	$student = $_POST["student"];
		
	$selected_section = CleverSection::retrieve($_POST["section"]);
	$section_json = json_decode($selected_section,true);
	
	$section_full = $section_json['course_name'];
	
	$pieces = explode(",", $section_full);
	$section = $pieces[0];
	
	$template_url = $template . '.php';
	include $template_url;

?>