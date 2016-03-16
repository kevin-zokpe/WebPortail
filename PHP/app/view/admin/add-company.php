<?php
	if (App::isAdmin()) :
		$id = $_SESSION['id'];
		$admin_password = Student::getStudentById($id)->password;

		if(isset($_FILES['logo'])){
			$my_file = basename($_FILES['logo']['name']);
			$max_file_size = 6000000;
			$file_size = filesize($_FILES['logo']['tmp_name']);
			$file_ext = strrchr($_FILES['logo']['name'], '.'); 
		}

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

									if (isset($_FILES['logo']) && ($file_ext == '.jpg' || $file_ext == '.png') && $file_size < $max_file_size){

										$id_company = Company::getCompanyIDByEmail($_POST['email']);

										$folder = "uploads/companies";
										if($file_ext == '.jpg')
          									$file = $folder . '/' . $id_company->id . '.jpg';
          								if($file_ext == '.png')
          									$file = $folder . '/' . $id_company->id . '.png';
         								move_uploaded_file($_FILES['logo']['tmp_name'], $file);

         								PDOConnexion::setParameters('stages', 'root', 'root');
										$dbh = PDOConnexion::getInstance();
										$req = "UPDATE company SET logo = :logo WHERE id = :id";
										$st = $dbh->prepare($req);
										$st->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
										$st->execute(array(
											':logo' => $file,
											':id' => $id_company->id
										));

									}
									else {
										if ($file_ext != '.jpg' && $file_ext != '.png'){							
											$msg->error('Le logo doit être au format JPG ou PNG','index.php?page=admin/add-company');
										}
										if ($file_size > $max_file_size){							
											$msg->error('Le logo est trop lourd, choisissez un autre fichier','index.php?page=admin/add-company');
										}
									}
									
									if ($sth) {
										$msg->success('L\'entreprise à bien été ajoutée. <br /> Son mot de passe est le vôtre. <br /> Vous pourez le changer ultérieurement', 'index.php?page=admin/companies-list');
									}
								
								else {
									$msg->error('L\'en n\'a pas été ajoutée','index.php?page=admin/add-company');
								}
							}

							else {
								$msg->error('Vous devez renseigner un site internet','index.php?page=admin/add-company');
							}
						}

						else {
							$msg->error('Vous devez renseigner une description','index.php?page=admin/add-company');
						}
					}

					else {
						$msg->error('Vous devez renseigner la ville','index.php?page=admin/add-company');
					}
				}

				else {
					$msg->error('Vous devez renseigner le pays','index.php?page=admin/add-company');
				}
			}
			else {
				$msg->error('Email manquant ou déjà existant','index.php?page=admin/add-company');
			}
		}
		else {
			$msg->error('Vous devez renseigner le nom de l\'entreprise','index.php?page=admin/add-company');	
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
					<form action="index.php?page=admin/add-company" method="POST" enctype="multipart/form-data">

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
								<div class="col-md-6">
									<label for="signup-logo">Logo</label>
									<input type="file" name="logo" id="signup-logo" placeholder="Insérer votre logo" required="required" data-validation-error-msg="Vous devez insérer un logo !">
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
							<button type="submit" class="btn btn-primary" name="add-company">Ajouter</button>
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
