<?php
	$id = $_GET['id'];
	$student = Student::getStudentById($id);
	$new_file = $student->first_name . '_' . $student->last_name . '_CV.pdf';
	$file = BASE_LINK . '/public/uploads/cv/' . $id . '.pdf';
	// Entetes HTTP pour l'envoi
	header('Content-Type: application/pdf'); 
	header('Content-Disposition: attachment; filename="' . $new_file . '"');
	readfile($file);
	 
?>
