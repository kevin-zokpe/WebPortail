<?php
	if (isset($_POST['add']) && App::isAdmin()) {
		if (isset($_FILES['logo'])) {
			$my_file = basename($_FILES['logo']['name']);
			$max_file_size = 6000000;
			$file_size = filesize($_FILES['logo']['tmp_name']);
			$file_ext = strrchr($_FILES['logo']['name'], '.'); 
		}

		if (isset($_POST['name']) && !empty($_POST['name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name']) && isset($_POST['country']) && isset($_POST['type'])) {
			$addPartner = Partner::addPartner($_POST['name'], $_POST['type'], $_POST['country']);

			if (isset($_FILES['logo']) && ($file_ext == '.jpg' || $file_ext == '.png') && $file_size < $max_file_size) {
				$id_partner = Partner::getPartnerIDByName($_POST['name']);
				$folder = 'uploads/partners';

				if ($file_ext == '.jpg') {
					$file = $folder . '/' . $id_partner->id . '.jpg';
				}
          			
          		if ($file_ext == '.png') {
          			$file = $folder . '/' . $id_partner->id . '.png';
          		}

          		Partner::addLogo($id_partner->id, $file);
          		move_uploaded_file($_FILES['logo']['tmp_name'], $file);
			}

			else {
				if ($file_ext != '.jpg' && $file_ext != '.png') {							
					$msg->error('Le logo doit être au format JPG ou PNG', 'index.php?page=admin/add-partner');
				}

				if ($file_size > $max_file_size){							
					$msg->error('Le logo est trop lourd, choisissez un autre fichier', 'index.php?page=admin/add-partner');
				}
			}
			
			if ($addPartner) {
				$msg->success('Ce partenaire a bien été ajouté.', 'index.php?page=admin/partners-list');
			}
		}

		else {
			$msg->error('Veuillez entrer un nom valide pour ce partenaire.', 'index.php?page=admin/add-partner');
		}
	}
?>

<div class="col-md-8">
	<div class="page-header">
		<h1>Ajouter un Partenaire</h1>
	</div>

	<form action="index.php?page=admin/add-partner" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="partner-logo">Logo</label>
			<input type="file" id="partner-logo" name="logo" placeholder="Logo du partenaire">
		</div>

		<div class="form-group">
			<label for="partner-last-name">Nom</label>
			<input type="text" class="form-control" id="partner-name" required="required" name="name" placeholder="Nom du partenaire">
		</div>

		<div class="form-group">
			<label for="partner-type">Type</label>
			<select name="type" id="partner-type" class="form-control" required>
				<option value="" disabled>Choisissez le type de votre partenaire</option>
				<option value="company">Entreprise</option>
				<option value="university">Université</option>
			</select>
		</div>

		<div class="form-group">
			<label for="partner-country">Pays</label>
			<select name="country" id="partner-country" required="required" class="form-control">
				<option value="" disabled>Choisissez le pays de l'entreprise</option>
				<option value="France">France</option>
				<option value="Irlande">Irlande</option>
			</select>
		</div>

		<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
	</form>
</div>