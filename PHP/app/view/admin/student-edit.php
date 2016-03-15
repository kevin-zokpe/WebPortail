<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$student = Student::getStudentById($id);

		if (isset($_POST['edit'])) {
			$_POST['activated'] = (isset($_POST['activated'])) ? true : false;

			$my_file = basename($_FILES['cv']['name']);
			$max_file_size = 6000000;
			$file_size = filesize($_FILES['cv']['tmp_name']);
			$file_ext = strrchr($_FILES['cv']['name'], '.'); 

			if (isset($_POST['first_name']) && !empty($_POST['first_name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name']) &&
    		isset($_POST['last_name']) && !empty($_POST['last_name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name']) &&
    		isset($_POST['email']) && !empty($_POST['email']) && preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
    	   	isset($_POST['country'] ) && !empty($_POST['country']) &&
    	   	isset($_POST['skill']) && !empty($_POST['skill']) &&
    	   	preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST['portfolio'])) {



				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE student
					SET first_name = :first_name,
						last_name = :last_name,
						country = :country,
						skill = :skill,
						email = :email,
						portfolio = :portfolio,
						activated = :activated
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
				$sth->execute(array(
					':id' => $id,
					':first_name' => $_POST['first_name'],
					':last_name' => $_POST['last_name'],
					':country' => $_POST['country'],
					':skill' => $_POST['skill'],
					':email' => $_POST['email'],
					':portfolio' => $_POST['portfolio'],
					':activated' => $_POST['activated']
				));

				if (isset($_FILES['cv']) && $_FILES['cv']['name']!=''){

						$my_file = basename($_FILES['cv']['name']);
						$max_file_size = 6000000;
						$file_size = filesize($_FILES['cv']['tmp_name']);
						$file_ext = strrchr($_FILES['cv']['name'], '.'); 

						if ($file_ext == '.pdf' && $file_size < $max_file_size){

							$folder = "uploads/cv";
          					$file = $folder . '/' . $id . '.pdf';
          					if(file_exists($file)) unlink($file);
         					move_uploaded_file($_FILES['cv']['tmp_name'], $file);

         					PDOConnexion::setParameters('stage', 'root', 'root');
							$dbh = PDOConnexion::getInstance();
							$req = "
								UPDATE student
								SET cv = :cv
								WHERE id = :id
							";
							$stt = $dbh->prepare($req);
							$stt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
							$stt->execute(array(
								':id' => $id,
								':cv' => $file
							));

							if ($stt) {
         						$msg->success("Le CV de l'étudiant a bien été modifié.",'index.php?page=admin/students-list');
         					}
						}
						else {
							if ($file_ext != '.pdf'){							
								$msg->error('Le CV doit être au format PDF','index.php?page=admin/student-edit&id=' . $id);
							}
							if ($file_size > $max_file_size){							
								$msg->error('Le CV est trop lourd, choisissez un autre fichier','index.php?page=admin/student-edit&id=' . $id);
							}
						}	
			
					if ($sth) {
						$msg->success('Cet étudiant a bien été modifié.','index.php?page=admin/students-list');
					}
				}
			}
			else{

				if ((!isset($_POST['first_name']) || empty($_POST['first_name'])) || 
				(!isset($_POST['last_name']) || empty($_POST['last_name'])) ||
				(!isset($_POST['email']) || empty($_POST['email'])) ||
				(!isset($_POST['country']) || empty($_POST['country'])) ||
				(!isset($_POST['skill']) || empty($_POST['skill']))) {
					$msg->error('Vous devez remplir tous les champs obligatoires','index.php?page=admin/student-edit&id=' . $id);
				}

				if (!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name'])){
					$msg->error("Veuillez entrer un prénom approprié",'index.php?page=admin/student-edit&id=' . $id);
				}

				if (!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name'])){
					$msg->error("Veuillez entrer un nom approprié",'index.php?page=admin/student-edit&id=' . $id);
				}

				if (!preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
					$msg->error("Veuillez entrer un email approprié",'index.php?page=admin/student-edit&id=' . $id);
				}

				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST['portfolio'])){
					$msg->error("Veuillez entrer une adresse web appropriée",'index.php?page=admin/student-edit&id=' . $id);
				}

			}
		}

		if ($student) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer un étudiant
							<small><?php echo $student->first_name . ' ' .  $student->last_name; ?></small>
						</h1>
					</div>

					<form action="index.php?page=admin/student-edit&amp;id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="student-last-name">Nom</label>
							<input type="text" class="form-control" id="student-last-name" required="required" value="<?php echo $student->last_name; ?>" name="last_name" placeholder="Nom de famille de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-first-name">Prénom</label>
							<input type="text" class="form-control" id="student-first-name" required="required" value="<?php echo $student->first_name; ?>" name="first_name" placeholder="Prénom de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-country">Pays</label>
							<select name="country" id="student-country" required="required" class="form-control">
								<option value="" disabled>Choisissez le pays de l'étudiant</option>
								<option value="France"<?php if ($student->country == 'France') {echo ' selected';} ?>>France</option>
								<option value="Irlande"<?php if ($student->country == 'Irlande') {echo ' selected';} ?>>Irlande</option>
							</select>
						</div>

						<div class="form-group">
							<label for="student-skill">Domaine de compétences</label>
							<select name="skill" id="student-skill" required="required" class="form-control">
								<option value="" disabled selected>Choisissez votre domaine de compétences</option>
								<?php
									foreach (Skill::getSkillsList() as $skill) {
										$selected = ($student->skill == $skill->id) ? ' selected' : '';
										echo '<option value="' . $skill->id . '"' . $selected . '>' . $skill->name . '</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="student-email">Adresse email</label>
							<input type="text" class="form-control" id="student-email" required="required" value="<?php echo $student->email; ?>" name="email" placeholder="Adresse email de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-cv">CV</label>
							<input type="file" id="student-cv" name="cv" placeholder="CV du partenaire">
						</div>

						<div class="form-group">
							<label for="student-portfolio">Portfolio</label>
							<input type="text" class="form-control" id="student-portfolio" value="<?php echo $student->portfolio; ?>" name="portfolio" placeholder="Portfolio de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-activated">Confirmé</label>
							<div class="checkbox">
								<label><input type="checkbox" name="activated"<?php if ($student->activated) {echo ' checked';} ?>> Étudiant confirmé</label>
							</div>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/students-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/students-list');
	}
?>
