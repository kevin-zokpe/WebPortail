<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$student = Student::getStudentById($id);
		
		if (!$student->activated) {
			if (Student::activateStudent($id)) {
				App::redirect('index.php?page=admin/students-list');
			}

			else {
				App::error('Erreur lors de la validation de l\'étudiant');
			}
		}

		else {
			App::error('Cet étudiant a déjà été confirmé');
		}
	}

	else {
		App::redirect('index.php?page=admin/students-list');
	}
?>