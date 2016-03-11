<?php

	if (isset($_POST['add'])) {

		if(isset($_FILES['logo'])){
			$my_file = basename($_FILES['logo']['name']);
			$max_file_size = 6000000;
			$file_size = filesize($_FILES['logo']['tmp_name']);
			$file_ext = strrchr($_FILES['logo']['name'], '.'); 
		}

		if (isset($_POST['name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name']) &&
			isset($_POST['country'])) {

			$name = $_POST['name'];
			$country = $_POST['country'];

			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO partner(name, country, register_date)
				VALUES (:name, :country, NOW())
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':name' => $name,
				':country' => $country
			));

			if (isset($_FILES['logo']) && ($file_ext == '.jpg' || $file_ext == '.png') && $file_size < $max_file_size){

				$id_partner = Partner::getPartnerIDByName($name);

				$folder = "uploads/partners";
				if($file_ext == '.jpg')
          				$file = $folder . '/' . $id_partner->id . '.jpg';
          			if($file_ext == '.png')
          				$file = $folder . '/' . $id_partner->id . '.png';
         			move_uploaded_file($_FILES['logo']['tmp_name'], $file);

         		PDOConnexion::setParameters('stages', 'root', 'root');
				$dbh = PDOConnexion::getInstance();
				$req = "UPDATE partner SET logo = :logo WHERE id = :id";
				$st = $dbh->prepare($req);
				$st->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
				$st->execute(array(
					':logo' => $file,
					':id' => $id_partner->id
				));

			}
			
			if ($sth) {
				App::success('Ce partenaire a bien été ajouté.');
			}
		}
	}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter un Partenaire
						</h1>
					</div>

					<form action="index.php?page=admin/add-partner" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="partner-last-name">Nom</label>
							<input type="text" class="form-control" id="partner-name" name="name" placeholder="Nom du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-logo">Logo</label>
							<input type="file" id="partner-logo" name="logo" placeholder="Logo du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-country">Pays</label>
							<select name="country" id="partner-country" class="form-control">
								<option value="" disabled>Choisissez le pays de l'entreprise</option>
								<option value="France">France</option>
								<option value="Irlande">Irlande</option>
							</select>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
