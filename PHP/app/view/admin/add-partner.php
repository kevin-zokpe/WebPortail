<?php

		if (isset($_POST['add'])) {
			$name = $_POST['name'];

			if (isset($_POST['logo'])){
				$logo = $_POST['logo'];
			}
			else{
				$logo = '';
			}

			$country = $_POST['country'];

			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO partner(name, logo, country, register_date)
				VALUES (:name, :logo, :country, NOW())
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':name' => $name,
				':logo' => $logo,
				':country' => $country
			));
			
			if ($sth) {
				App::success('Ce partenaire a bien été ajouté.');
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
