<?php
	$id = $_GET['id'];
	$student = Student::getStudentById($id);
	$new_file = $student->first_name . '_' . $student->last_name . '_CV.pdf';
	 
	// lecture binaire du fichier
	$content_file = file_get_contents(BASE_LINK . '/public/uploads/cv/' . $id . '.pdf');
	 
	// Entetes HTTP pour l'envoi
	header( 'Content-type: application/pdf'); 
	header( 'Content-length: ' . filesize(BASE_LINK . '/public/uploads/cv/' . $id . '.pdf'));
	header( 'Content-disposition: attachment; filename="'.$new_file.'"');
	 
	// envoi au navigateur
	echo $content_file;
?>