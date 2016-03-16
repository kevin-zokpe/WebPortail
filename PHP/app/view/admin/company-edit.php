<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$company = Company::getCompanyById($id);

		if (isset($_POST['edit'])) {
			$_POST['activated'] = (isset($_POST['activated'])) ? true : false;

			if (isset($_FILES['logo'])){
				$my_file = basename($_FILES['logo']['name']);
				$max_file_size = 6000000;
				$file_size = filesize($_FILES['logo']['tmp_name']);
				$file_ext = strrchr($_FILES['logo']['name'], '.');
			}

			if (isset($_POST['name']) && !empty($_POST['name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name']) &&
    			isset($_POST['email']) && !empty($_POST['email']) && preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
    		   	isset($_POST['country'] ) && !empty($_POST['country']) &&
    		   	isset($_POST['city']) && !empty($_POST['city']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['city']) &&
    		   	isset($_POST['description']) && preg_match("#^[a-zA-Z0-9._-]{2,128}#", $_POST['description']) &&
  	   			preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST['website'])) {

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE company
					SET name = :name,
						email = :email,
						country = :country,
						city = :city,
						description = :description,
						website = :website,
						activated = :activated
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
				$sth->execute(array(
					':id' => $id,
					':name' => $_POST['name'],
					':email' => $_POST['email'],
					':country' => $_POST['country'],
					':city' => $_POST['city'],
					':description' => $_POST['description'],
					':website' => $_POST['website'],
					':activated' => $_POST['activated']
				));

				if (isset($_FILES['logo']) && $_FILES['logo']['name']!=''){
					if ($file_ext == '.jpg' || $file_ext == '.png') {
						if ($file_size < $max_file_size) {
          					$folder = 'uploads/companies';
          					
          					if ($file_ext == '.jpg') {
          						$file = $folder . '/' . $id . '.jpg';
          					}
        			  			
        			  		if ($file_ext == '.png') {
        			  			$file = $folder . '/' . $id . '.png';
        			  		}
        			  			
        			 		move_uploaded_file($_FILES['logo']['tmp_name'], $file);

        			 		PDOConnexion::setParameters('stages', 'root', 'root');
							$dbh = PDOConnexion::getInstance();
							$req = "UPDATE company SET logo = :logo WHERE id = :id";
							$stt = $dbh->prepare($req);
							$stt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
							$stt->execute(array(
								':logo' => $file,
								':id' => $id
							));

							if ($stt) {
         						$msg->success("L'entreprise a bien été modifié.", 'index.php?page=admin/companies-list');
         					}

						}
						else{
							$msg->error("Votre logo est trop lourd, choisissez un autre fichier", 'index.php?page=admin/company-edit&amp;id=' . $id);
						}
					}

					else {
						$msg->error("Le logo doit être au format JPG ou PNG", 'index.php?page=admin/company-edit&amp;id=' . $id);
					}
				}

				else {
					if ($sth) {
						$msg->success('Cette entreprise a bien été modifié.', 'index.php?page=admin/companies-list');
					}

				}
			}

			else {
				if ((!isset($_POST['name']) || empty($_POST['name'])) || 
				(!isset($_POST['city']) || empty($_POST['city'])) ||
				(!isset($_POST['email']) || empty($_POST['email'])) ||
				(!isset($_POST['country']) || empty($_POST['country'])) ||
				(!isset($_POST['description']))) {
					$msg->error('Vous devez remplir tous les champs obligatoires', 'index.php?page=admin/company-edit&id='. $id);
				}

				if (!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name'])){
					$msg->error("Veuillez entrer un nom approprié", 'index.php?page=admin/company-edit&id='. $id);
				}

				if (!preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
					$msg->error('Veuillez entrer un email approprié', 'index.php?page=admin/company-edit&id=' . $id);
				}

				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST['website'])){
					$msg->error("Veuillez entrer une adresse web appropriée", 'index.php?page=admin/company-edit&id='. $id);
				}

				if (!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['city'])){
					$msg->error('Veuillez entrer une ville valide', 'index.php?page=admin/company-edit&id=' . $id);
				}
			}
		}

		if ($company) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer une entreprise
							<small><?php echo $company->name; ?></small>
						</h1>
					</div>

					<form action="index.php?page=admin/company-edit&amp;id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="company-last-name">Nom</label>
							<input type="text" class="form-control" id="company-name" required="required" value="<?php echo $company->name; ?>" name="name" placeholder="Nom de l'entreprise">
						</div>

						<div class="form-group">
							<label for="company-email">Adresse email</label>
							<input type="text" class="form-control" id="company-email" required="required" value="<?php echo $company->email; ?>" name="email" placeholder="Adresse email de l'entreprise">
						</div>

						<div class="form-group">
							<label for="company-country">Pays</label>
							<select name="country" id="company-country" required="required" class="form-control">
								<option value="" disabled>Choisissez le pays de l'entreprise</option>
								<option value="France"<?php if ($company->country == 'France') {echo ' selected';} ?>>France</option>
								<option value="Irlande"<?php if ($company->country == 'Irlande') {echo ' selected';} ?>>Irlande</option>
							</select>
						</div>

						<div class="form-group">
							<label for="company-portfolio">Ville</label>
							<input type="text" class="form-control" id="company-city" required="required" value="<?php echo $company->city; ?>" name="city" placeholder="Ville où est localisée l'entreprise">
						</div>

						<div class="row">
							<div class="col-md-6">
								<label for="signup-logo">Logo</label>
								<input type="file" name="logo" id="signup-logo" placeholder="Insérer votre logo" data-validation-error-msg="Vous devez insérer un logo !">
							</div>
						</div>

						<div class="form-group">
							<label for="company-portfolio">Description</label>
							<textarea class="form-control" id="company-description" name="description" placeholder="Description de l'entreprise"><?php echo $company->description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="company-portfolio">Site internet</label>
							<input type="text" class="form-control" id="company-website" value="<?php echo $company->website; ?>" name="website" placeholder="Adresse du site internet de l'entreprise">
						</div>

						<div class="form-group">
							<label for="company-activated">Confirmée</label>
							<div class="checkbox">
								<label><input type="checkbox" name="activated"<?php if ($company->activated) {echo ' checked';} ?>> Entreprise confirmée</label>
							</div>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/companies-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/companies-list');
	}
?>
