<?php
	if (App::isCompany()) :
		$company = Company::getCompanyById($_SESSION['id']);
		if (isset($_POST['edit'])) :
			if ($_POST['password'] == $_POST['password-confirm']) {
				if (Bcrypt::checkPassword($_POST['password'], $company->password)) {
					PDOConnexion::setParameters('phonedeals', 'root', 'root');
					$db = PDOConnexion::getInstance();
					$sql = "
						UPDATE company
						SET description = :description,
							website = :website
						WHERE id = :id
					";
					$sth = $db->prepare($sql);
					$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
					$sth->execute(array(
						':id' => $company->id,
						':description' => $_POST['description'],
						':website' => $_POST['website']
					));
					if ($sth) {
						App::success('Vos informations ont bien été modifiées');
					}
				}
				else {
					echo App::error('Le mot de passe entré est incorrect, veuillez réessayer.');
				}
			}
			else {
				echo App::error('Les deux mots de passes ne correspondent pas');
			}
		else:
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row" style="margin-bottom: 15px;">
					<div class="col-md-12">
						<h1>Profil</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
						<form action="index.php?page=profile-company" method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label">Nom</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $company->name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $company->email; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Pays</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $company->country; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Ville</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $company->city; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Description</label> 
								<div class="col-sm-10">
									<textarea class="form-control" id="description" name="description" placeholder="Décrivez votre entreprise en quelques lignes"><?php echo $company->description; ?></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="profile-portfolio" class="col-sm-2 control-label">Site internet</label>
								<div class="col-sm-10">
									<input type="url" class="form-control" id="website" name="website" value="<?php echo $company->website; ?>" placeholder="Lien du site web">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password" class="col-sm-2 control-label">Mot de passe</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password" name="password" placeholder="Mot de passe">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password-confirm" class="col-sm-2 control-label">Confirmer</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password-confirm" name="password-confirm" placeholder="Confirmer le mot de passe">
									<p class="help-block">Entrez votre mot de passe pour confirmer votre identité et valider les changements</p>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" name="edit">Mettre à jour</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		endif;
	else :
		App::getHeader(404);
	endif;
?>