<?php
	if (App::isStudent()) :
		$student = Student::getStudentById($_SESSION['id']);

		if (isset($_POST['edit'])) :
			if ($_POST['password'] == $_POST['password-confirm']) {
				if (Bcrypt::checkPassword($_POST['password'], $student->password)) {
					PDOConnexion::setParameters('phonedeals', 'root', 'root');
					$db = PDOConnexion::getInstance();
					$sql = "
						UPDATE student
						SET cv = :cv,
							portfolio = :portfolio
						WHERE id = :id
					";
					$sth = $db->prepare($sql);
					$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
					$sth->execute(array(
						':id' => $student->id,
						':cv' => $_POST['cv'],
						':portfolio' => $_POST['portfolio']
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
						<h1>Votre profil</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
						<form action="index.php?page=profile" method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label">Nom</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $student->last_name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Prénom</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $student->first_name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Pays</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $student->country; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Domaine</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo Skill::getSkillById($student->skill)->name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $student->email; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label for="profile-cv" class="col-sm-2 control-label">CV</label>
								<div class="col-sm-10">
									<input type="file" id="profile-cv" name="cv">
									<p class="help-block">Envoyez votre CV pour que les entreprises soient intéressées par votre profil</p>
								</div>
							</div>

							<div class="form-group">
								<label for="profile-portfolio" class="col-sm-2 control-label">Portfolio</label>
								<div class="col-sm-10">
									<input type="url" class="form-control" id="profile-portfolio" name="portfolio" value="<?php echo $student->portfolio; ?>" placeholder="Lien du portfolio">
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
									<p class="help-block">Entrez votre mot de passe pour confirmer votre identité et valider les modifications</p>
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