<?php
	$id = $_GET['id'];
	$student = Student::getStudentById($id);
	$new_file = $student->first_name . '_' . $student->last_name . '_CV.pdf';
	$file = 'uploads/cv/' . $id . '.pdf';

	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/pdf');
	    header("Content-Type: application/force-download");
	    header('Content-Disposition: attachment; filename=' . $new_file);
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    ob_clean();
	    flush();
	    readfile($file);
	    exit;
	}

	else {
		$msg->error('Le CV est introuvable.', 'index.php?page=view-profile-student&id=' . $id);
	}
?>
