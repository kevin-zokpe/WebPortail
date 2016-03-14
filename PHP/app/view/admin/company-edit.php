<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$company = Company::getCompanyById($id);

		if (isset($_POST['edit'])) {
			$_POST['activated'] = (isset($_POST['activated'])) ? true : false;

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
			
			if ($sth) {
				$msg->success('Cette entreprise a bien été modifié.','index.php?page=admin/companies-list');
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

					<form action="index.php?page=admin/company-edit&amp;id=<?php echo $id; ?>" method="POST">
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
