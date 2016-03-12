<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$internship = internship::getInternshipById($id);
		
		if (isset($_POST['edit'])) {

			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE internship
				SET description = :description,
					address = :address,
					city = :city,
					zip_code = :zip_code,
					skill = :skill
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':id' => $id,
				':description' => $_POST['internship_description'],
				':address' => $_POST['internship_address'],
				':city' => $_POST['internship_city'],
				':zip_code' => $_POST['internship_zipcode'],
				':skill' => $_POST['internship_domain']
			));
			
			if ($sth) {
				App::success('Ce stage a bien été modifiée.');
			}
		}

		if ($internship) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer le stage :
							<small><?php echo $internship->name; ?></small>
						</h1>
					</div>

					<form action="index.php?page=admin/internship-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
								<label class="col-sm-2 control-label">Entreprise</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo Company::getCompanyById($internship->company)->name ?></p>
								</div>
							</div>

						<div class="form-group">
							<label for="internship_company">Poste</label>
							<input type="text" class="form-control" id="internship_company" required="required" value="<?php echo $internship->name ?>" name="internship_company" placeholder="Nom de l'entreprise">
						</div>


						<div class="form-group">
							<label for="internship_description">Description</label>
							<input type="text" class="form-control" id="internship_description" value="<?php echo $internship->description ?>" name="internship_description" placeholder="Description du stage">
						</div>


						<div class="form-group">
							<label for="internship_domain">Domaine de compétences</label>
							<select name="internship_domain" id="internship_domain" required="required" class="form-control">
								<option value="" disabled selected>Choisissez votre domaine de compétences</option>
								<?php
									foreach (Skill::getSkillsList() as $skill) {
										$selected = ($internship->skill == $skill->id) ? ' selected' : '';
										echo '<option value="' . $skill->id . '"' . $selected . '>' . $skill->name . '</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="internship_address">Adresse</label>
							<input type="text" class="form-control" id="internship_address" required="required" value="<?php echo $internship->address; ?>" name="internship_address" placeholder="Adresse">
						</div>

						<div class="form-group">
							<label for="internship_city">City</label>
							<input type="text" class="form-control" id="partner-name" required="required" value="<?php echo $internship->city; ?>" name="internship_city" placeholder="Ville">
						</div>

						<div class="form-group">
							<label for="internship_zipcode">Code postale</label>
							<input type="text" class="form-control" id="internship_zipcode" required="required" value="<?php echo $internship->zip_code; ?>" name="internship_zipcode" placeholder="Code postale">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/internships-list&country=France');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/internships-list&country=France');
	}
?>
