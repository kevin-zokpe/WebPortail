<?php
	if (App::isStudent()) :
		$student = Student::getStudentById($_SESSION['id']);

		if (isset($_POST['edit'])) :
			if (isset($_POST['password']) && $_POST['password'] == $_POST['password-confirm']) {
				if (Bcrypt::checkPassword($_POST['password'], $student->password)) {
					if(isset($_POST['new-password']) && $_POST['new-password']!=''){
						if(preg_match("#^[a-zA-Z\@._-]{2,32}#", $_POST['new-password'])){
							$new_password = Bcrypt::hashPassword($_POST['new-password']);
							Student::changePassword($new_password, $student->id);							
							App::success('Votre mot de passe a bien été modifié');
						}
						else{
							$msg->error('Veuillez entrer un nouveau mot de passe approprié','index.php?page=profile-student'
);
						}	
					}

					if(isset($_POST['portfolio']) && $_POST['portfolio']!='' && $_POST['portfolio']!=$student->portfolio){
						if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST['portfolio'])){
							Student::changePortfolio($_POST['portfolio'], $student->id);							
							App::success('Votre portfolio a bien été modifié');
						}
						else{
							$msg->error('Veuillez entrer un url approprié','index.php?page=profile-student');
						}	
					}

					if(isset($_FILES['cv']) && $_FILES['cv']['name']!=''){

						$my_file = basename($_FILES['cv']['name']);
						$max_file_size = 6000000;
						$file_size = filesize($_FILES['cv']['tmp_name']);
						$file_ext = strrchr($_FILES['cv']['name'], '.'); 

						if($file_ext == '.pdf' && $file_size < $max_file_size){	
							$folder = "uploads/cv";
          						$file = $folder . '/' . $student->id . '.pdf';
          						if(file_exists($file)){
          							unlink($file);
          						}
         						move_uploaded_file($_FILES['cv']['tmp_name'], $file);

							$editCv = Student::editCv($id, $file);

							if ($editCv) {
     								$msg->success('Votre CV a bien été modifié.', 'index.php?page=profile-student&id=' . $_SESSION['id']);
     							}
						}
						else{
							if($file_ext != '.pdf'){							
								$msg->error('Votre CV doit être au format PDF','index.php?page=profile-student');
							}
							if($file_size > $max_file_size){							
								$msg->error('Votre CV est trop lourd, choisissez un autre fichier','index.php?page=profile-student');
							}
						}	
					}
				}

				else {
					echo $msg->error('Le mot de passe entré est incorrect, veuillez réessayer','index.php?page=profile-student');
				}
			}

			else {
				echo $msg->error('Les deux mots de passe ne correspondent pas','index.php?page=profile-student');
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
						<form action="index.php?page=profile-student" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
								<label for="profile-new-password" class="col-sm-2 control-label">Nouveau mot de passe</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-new-password" name="new-password" placeholder="Si vous désirez changer de mot de passe">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-portfolio" class="col-sm-2 control-label">Portfolio</label>
								<div class="col-sm-10">
									<input type="url" class="form-control" id="profile-portfolio" name="portfolio" value="<?php echo $student->portfolio; ?>" placeholder="Lien du portfolio">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password" class="col-sm-2 control-label">Entrer votre mot de passe *</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password" required='required' name="password" placeholder="Mot de passe actuel">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password-confirm" class="col-sm-2 control-label">Confirmer votre mot de passe *</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password-confirm" required='required' name="password-confirm" placeholder="Confirmer le mot de passe">
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
