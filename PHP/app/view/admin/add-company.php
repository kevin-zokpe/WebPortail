<?php
	if (App::isAdmin()) :
		$id = $_SESSION['id'];
		$admin_password = Student::getStudentById($id)->password;

		if (isset($_POST['add-company'])) {
			if (isset($_POST['name']) && !empty($_POST['name'])) {
				if (isset($_POST['email']) && !empty($_POST['email']) && Company::checkEmailExist($_POST['email'])==false) {
					if (isset($_POST['country']) && !empty($_POST['country'])) {
						if (isset($_POST['city']) && !empty($_POST['city'])) {
							if (isset($_POST['description']) && !empty($_POST['description'])) {
								if (isset($_POST['website']) && !empty($_POST['website'])) {

									PDOConnexion::setParameters('stages', 'root', 'root');
									$db = PDOConnexion::getInstance();
									$sql = "
										INSERT INTO company(name, email, country, city, description, password, website, activated, register_date)
										VALUES (:name, :email, :country, :city, :description, :password, :website, true, NOW())
									";
									$sth = $db->prepare($sql);
									$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
									$sth->execute(array(
										':name' => $_POST['name'],
										':email' => $_POST['email'],
										':country' => $_POST['country'],
										':city' => $_POST['city'],
										':description' => $_POST['description'],
										':password' => $admin_password,
										':website' => $_POST['website']
									));
									
									if ($sth) {
										App::success('L\'entreprise à bien été ajoutée.');
									}
								
								else {
									App::error('L\'en n\'a pas été ajoutée');
								}
							}

							else {
								App::error('Vous devez renseigner un site internet');
							}
						}

						else {
							App::error('Vous devez renseigner une description');
						}
					}

					else {
						App::error('Vous devez renseigner la ville');
					}
				}

				else {
					App::error('Vous devez renseigner le pays');
				}
			}
			else {
				App::error('Email manquant ou déjà existant');
			}
		}
		else {
			App::error('Vous devez renseigner le nom de l\'entreprise');	
		}
	}

		else {
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="page-header">
					<h1> Ajouter une entreprise </h1>
				</div>
					<form action="index.php?page=admin/add-company" method="POST">

							<div class="row">
								<div class="col-md-12">
									<label for="signup-name">Nom de l'entreprise </label>
									<input type="text" name="name" class="form-control" required="required" id="signup-name" placeholder="Nom" data-validation="length" data-validation-length="2-30"  data-validation-error-msg="Entrez le nom de votre entreprise !">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<label for="signup-email">Adresse email</label>
									<input type="text" name="email" class="form-control" required="required" id="signup-email" placeholder="Adresse email" data-validation="email"  data-validation-error-msg="Adresse mail invalide !">
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<label for="signup-country">Pays</label>
									<select name="country" id="signup-country" required="required" class="form-control">
										<option value="" disabled selected>Choisissez votre pays</option>
										<option value="France">France</option>
										<option value="Irlande">Irlande</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="signup-city">Ville</label>
									<input type="text" name="city" class="form-control" required="required" id="signup-city" placeholder="Ville" data-validation="city"  data-validation-error-msg="Ville invalide !">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<label for="signup-description">Description</label>
									<textarea name="description" id="signup-description" class="form-control" rows="3" placeholder="Description" data-validation-length="2-30"  data-validation-error-msg="Rédigez une description de l'entreprise !" required></textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<label for="signup-website">Site web</label>
									<input type="text" name="website" class="form-control" id="signup-website" placeholder="Site web" data-validation="length" data-validation-length="16-128" data-validation-error-msg="Vous devez entrer un site web !">
								</div>
							</div>
							<button type="submit" class="btn btn-primary" name="add-company">Ajouter le stage</button>
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
