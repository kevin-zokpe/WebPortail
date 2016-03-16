<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$partner = Partner::getPartnerById($id);

		if (isset($_POST['edit'])) {

			if (isset($_POST['name']) && $_POST['name']!='' && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name']) &&
				isset($_POST['country'])){

					PDOConnexion::setParameters('stages', 'root', 'root');
					$db = PDOConnexion::getInstance();
					$sql = "
						UPDATE partner
						SET name = :name,
							country = :country
						WHERE id = :id
					";
					$sth = $db->prepare($sql);
					$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
					$sth->execute(array(
						':id' => $id,
						':name' => $_POST['name'],
						':country' => $_POST['country']
					));

					if (isset($_FILES['logo']) && $_FILES['logo']['name']!=''){

						$my_file = basename($_FILES['logo']['name']);
						$max_file_size = 6000000;
						$file_size = filesize($_FILES['logo']['tmp_name']);
						$file_ext = strrchr($_FILES['logo']['name'], '.'); 

						if (($file_ext == '.jpg' || $file_ext == '.png') && $file_size < $max_file_size){

							$folder = "uploads/partners";
							if($file_ext == '.jpg')
          						$file = $folder . '/' . $id . '.jpg';
          					if($file_ext == '.png')
          						$file = $folder . '/' . $id . '.png';
          					if(file_exists($file)) unlink($file);
         					move_uploaded_file($_FILES['logo']['tmp_name'], $file);

         					PDOConnexion::setParameters('stages', 'root', 'root');
							$dbh = PDOConnexion::getInstance();
							$req = "
								UPDATE partner
								SET logo = :logo
								WHERE id = :id
							";
							$stt = $dbh->prepare($req);
							$stt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
							$stt->execute(array(
								':id' => $id,
								':logo' => $file
							));

							if ($stt) {
         						$msg->success('Le partenaire a bien été modifié.','index.php?page=admin/partners-list');
         					}
						}
						else {
							if ($file_ext != '.jpg' && $file_ext != '.png'){							
								$msg->error('Le logo doit être au format JPG ou PNG','index.php?page=admin/partner-edit&amp;id='. $id);
							}
							if ($file_size > $max_file_size){							
								$msg->error('Le logo est trop lourd, choisissez un autre fichier','index.php?page=admin/partner-edit&amp;id='. $id);
							}
						}	
					}
					else {
						if ($sth) {
							$msg->success('Ce partenaire a bien été modifié.','index.php?page=admin/partners-list');
						}
					}
			}

			else {
				$msg->error('Veuillez entrer un nom valide pour ce partenaire', 'index.php?page=admin/partner-edit&amp;id='. $id);
			}
		}

		if ($partner) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer un Partenaire
							<small><?php echo $partner->name; ?></small>
						</h1>
					</div>

					<form action="index.php?page=admin/partner-edit&amp;id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="partner-logo">Logo</label>
							<input type="file" id="partner-logo" value="<?php echo $partner->logo; ?>" name="logo" placeholder="Logo du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-last-name">Nom</label>
							<input type="text" class="form-control" id="partner-name" required="required" value="<?php echo $partner->name; ?>" name="name" placeholder="Nom du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-country">Pays</label>
							<select name="country" id="partner-country" required="required" class="form-control">
								<option value="" disabled>Choisissez le pays de l'entreprise</option>
								<option value="France"<?php if ($partner->country == 'France') {echo ' selected';} ?>>France</option>
								<option value="Irlande"<?php if ($partner->country == 'Irlande') {echo ' selected';} ?>>Irlande</option>
							</select>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/partners-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/partners-list');
	}
?>
