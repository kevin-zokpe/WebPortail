<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$student = Student::getStudentById($id);
		
		if (!$student->activated) {
			if (Student::activateStudent($id)) {
				App::redirect('index.php?page=admin/students-list');
			}

			else {
				$msg->error('Erreur lors de la validation de l\'étudiant','index.php?page=admin/students-list&type=awaiting');
			}
		}

		else {
			$msg->error('Cet étudiant a déjà été confirmé','index.php?page=admin/students-list&type=awaiting');
		}
	}

	else {
		App::redirect('index.php?page=admin/students-list&type=awaiting');
	}
?>