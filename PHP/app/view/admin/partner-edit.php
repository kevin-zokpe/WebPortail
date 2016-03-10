<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$partner = Partner::getPartnerById($id);

		if (isset($_POST['edit'])) {

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE partner
				SET name = :name,
					logo = :logo,
					country = :country
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':id' => $id,
				':name' => $_POST['name'],
				':logo' => $_POST['logo'],
				':country' => $_POST['country']
			));
			
			if ($sth) {
				App::success('Ce partenaire a bien été modifiée.');
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
							<label for="partner-last-name">Nom</label>
							<input type="text" class="form-control" id="partner-name" value="<?php echo $partner->name; ?>" name="name" placeholder="Nom du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-logo">Logo</label>
							<input type="file" id="partner-logo" value="<?php echo $partner->logo; ?>" name="logo" placeholder="Logo du partenaire">
						</div>

						<div class="form-group">
							<label for="partner-country">Pays</label>
							<select name="country" id="partner-country" class="form-control">
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
