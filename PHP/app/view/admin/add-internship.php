<?php
	if (App::isAdmin()) :
		$country = $_GET['country'];

		if (isset($_POST['add-internship'])) {
			if (isset($_POST['name']) && !empty($_POST['name'])) {
				if (isset($_POST['description']) && !empty($_POST['description'])) {
					if (isset($_POST['company']) && !empty($_POST['company'])) {
						if (isset($_POST['address']) && !empty($_POST['address'])) {
							if (isset($_POST['zip_code']) && !empty($_POST['zip_code'])) {
								if (isset($_POST['city']) && !empty($_POST['city'])) {
									if (isset($_POST['skill']) && !empty($_POST['skill'])) {
									PDOConnexion::setParameters('stages', 'root', 'root');
									$db = PDOConnexion::getInstance();
									$sql = "
										INSERT INTO internship (name, description, company, address, zip_code, city, skill)
										VALUES (:name, :description, :company, :address, :zip_code, :city, :skill)
									";
									$sth = $db->prepare($sql);
									$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
									$sth->execute(array(
										':name' => $_POST['name'],
										':description' => $_POST['description'],
										':company' => $_POST['company'],
										':address' => $_POST['address'],
										':zip_code' => $_POST['zip_code'],
										':city' => $_POST['city'],
										':skill' => $_POST['skill']
									));
									
									if ($sth) {
										$msg->success('Le stage à bien été ajouté.','index.php?page=admin/internship-list');
									}
								}

								else {
									$msg->error('Vous devez renseigner le domaine d\'activité du stage.','index.php?page=admin/add-internship');
								}
							}

							else {
								$msg->error('Vous devez renseigner la ville où se déroule le stage.','index.php?page=admin/add-internship');
							}
						}

						else {
							$msg->error('Vous devez renseigner le code postal du lieu où se déroule le stage.','index.php?page=admin/add-internship');
						}
					}

					else {
						$msg->error('Vous devez renseigner l\'adresse où se déroule le stage.','index.php?page=admin/add-internship');
					}
				}

				else {
					$msg->error('Vous devez renseigner la description du stage.','index.php?page=admin/add-internship');
				}
			}
			else {
				$msg->error('Vous devez renseigner le poste du stage.','index.php?page=admin/add-internship');
			}
		}
		else {
			$msg->error('Vous devez renseigner l\'entreprise.','index.php?page=admin/add-internship');	
		}
	}

		else {
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1> Ajouter un stage en <?php echo $country;?> </h1>
				</div>
				<form action="index.php?page=admin/add-internship&amp;country=<?php echo $country; ?>" method="POST">
					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="company">Entreprise</label>
								<select name="company" class="form-control">
									<option value="internship-company" disabled selected>Sélectionnez une entreprise</option>
									<?php
									if ($country=="France") {
										foreach (Company::getCompaniesListInFrance() as $company) {
											echo '<option value="' . $company->id . '">' . $company->name . '</option>';
										}
									}
									else {
										foreach (Company::getCompaniesListInIrland() as $company) {
											echo '<option value="' . $company->id . '">' . $company->name . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="name">Poste</label>
								<input type="text" placeholder="Nom du poste" required="required" name="name" value="" id="internship-name" class="form-control">
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="skill">Domaine de compétence</label>
								<select name="skill" required="required" class="form-control">
									<option value="" disabled selected>Sélectionnez un domaine de compétence</option>
									<?php
										foreach (Skill::getSkillsList() as $skill) {
											echo '<option value="' . $skill->id . '">' . $skill->name . '</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label style="width: 100%;" for="description">Description</label>
								<textarea placeholder="Décrivez le poste à pourvoir" name="description" value="" id="internship-description" class="form-control"></textarea>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="internship-address">Adresse</label>
								<input type="text" placeholder="Adresse postale" required="required" name="address" value="" id="internship-address" class="form-control">
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-4">
								<label for="internship-zipcode">Code postal</label>
								<input type="text" placeholder="Code postal" required="required" name="zip_code" value="" id="internship-zipcode" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="internship-city">Ville</label>
								<input type="text" placeholder="Ville" name="city" required="required" value="" id="internship-city" class="form-control">
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary" name="add-internship">Ajouter le stage</button>
				</form>
			</div>
		</div>
	</div>
<?php
	}

	else:
		App::redirect('index.php?page=admin/internships-list&country=France');
	endif;
?>
