<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$company = Company::getCompanyById($id);
		
		if (!$company->activated) {
			if (Company::activateCompany($id)) {
				App::redirect('index.php?page=admin/companies-list');
			}

			else {
				App::error('Erreur lors de la validation de l\'entreprise');
			}
		}

		else {
			App::error('Cette entreprise a déjà été confirmée');
		}
	}

	else {
		App::redirect('index.php?page=admin/students-list');
	}
?>