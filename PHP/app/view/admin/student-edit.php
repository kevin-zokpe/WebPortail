<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$student = Student::getStudentById($id);

		if (isset($_POST['edit'])) {
			$_POST['activated'] = (isset($_POST['activated'])) ? true : false;

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
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
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
			
			if ($sth) {
				App::success('Cet étudiant a bien été modifié');
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

					<form action="index.php?page=admin/student-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
							<label for="student-last-name">Nom</label>
							<input type="text" class="form-control" id="student-last-name" value="<?php echo $student->last_name; ?>" name="last_name" placeholder="Nom de famille de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-first-name">Prénom</label>
							<input type="text" class="form-control" id="student-first-name" value="<?php echo $student->first_name; ?>" name="first_name" placeholder="Prénom de l'étudiant">
						</div>

						<div class="form-group">
							<label for="student-country">Pays</label>
							<select name="country" id="student-country" class="form-control">
								<option value="" disabled>Choisissez le pays de l'étudiant</option>
								<option value="France"<?php if ($student->country == 'France') {echo ' selected';} ?>>France</option>
								<option value="Irlande"<?php if ($student->country == 'Irlande') {echo ' selected';} ?>>Irlande</option>
							</select>
						</div>

						<div class="form-group">
							<label for="student-skill">Domaine de compétences</label>
							<select name="skill" id="student-skill" class="form-control">
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
							<input type="text" class="form-control" id="student-email" value="<?php echo $student->email; ?>" name="email" placeholder="Adresse email de l'étudiant">
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
