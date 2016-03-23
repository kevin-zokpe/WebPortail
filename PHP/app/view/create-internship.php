<?php
	if (App::isCompany()) :
		$company = Company::getCompanyById($_SESSION['id']);

		if (isset($_POST['skill'])) {
			if (isset($_POST['name']) && !empty($_POST['name'])) {
				if (isset($_POST['description']) && !empty($_POST['description'])) {
					if (isset($_POST['address']) && !empty($_POST['address'])) {
						if (isset($_POST['zip_code']) && !empty($_POST['zip_code'])) {
							if (isset($_POST['city']) && !empty($_POST['city'])) {
								if (isset($_POST['skill']) && !empty($_POST['skill'])) {
										$addInternship=Internship::addInternship($_POST['name'],$_POST['description'],$company->id,$_POST['address'],$_POST['zip_code'],$_POST['city'],$_POST['skill']);

									if ($addInternship) {
										App::redirect('index.php?page=my-internships');
									}
								}

								else {
									$msg->error('Vous devez renseigner le domaine d\'activité du stage.','index.php?page=create-internship');
								}
							}

							else {
								$msg->error('Vous devez renseigner la ville où se déroule le stage.','index.php?page=create-internship');
							}
						}

						else {
							$msg->error('Vous devez renseigner le code postal du lieu où se déroule le stage.','index.php?page=create-internship');
						}
					}

					else {
						$msg->error('Vous devez renseigner l\'adresse où se déroule le stage.','index.php?page=create-internship');
					}
				}

				else {
					$msg->error('Vous devez renseigner la description du stage.','index.php?page=create-internship');
				}
			}

			else {
				$msg->error('Vous devez renseigner l\'intitulé du stage.','index.php?page=create-internship');
			}
		}

		else {
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1>Proposer un stage</h1>
				</div>
				<form action="index.php?page=create-internship" method="POST">
					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="internship-name">Poste</label>
								<input type="text" placeholder="Nom du poste" name="name" value="" id="internship-name" class="form-control">
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label style="width: 100%;" for="internship-description">Description</label>
								<textarea placeholder="Décrivez le poste à pourvoir" name="description" value="" id="internship-description" class="form-control"></textarea>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="internship-address">Adresse</label>
								<input type="text" placeholder="Adresse postale" name="address" value="" id="internship-address" class="form-control">
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-4">
								<label for="internship-zipcode">Code postal</label>
								<input type="text" placeholder="Code postal" name="zip_code" value="" id="internship-zipcode" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="internship-zipcode">Ville</label>
								<input type="text" placeholder="Ville" name="city" value="" id="internship-city" class="form-control">
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="form-group">
							<div class="col-md-8">
								<label for="internship-zipcode">Domaine de compétence</label>
								<select name="skill" class="form-control">
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
					
					<button type="submit" class="btn btn-primary">Envoyer</button>
				</form>
			</div>
		</div>
	</div>
<?php
	}

	else:
		App::redirect('index.php?page=home');
	endif;
?>