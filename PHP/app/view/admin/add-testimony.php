<?php
	if (App::isAdmin()) {

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['author']) && preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author']) && isset($_POST['description'])){

				$author = $_POST['author'];
				$description = $_POST['description'];

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO testimony(author, description, register_date)
					VALUES (:author, :description, NOW())
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Testimony');
				$sth->execute(array(
					':author' => $author,
					':description' => $description
				));
			
				if ($sth) {
					App::success('Ce témoignage a bien été ajoutée.');
				}
			}
			
			else {

				if(!isset($_POST['author']) || !preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author'])){
					App::error("Veuillez entrer un nom d'auteur valide.");
				}

				if(!isset($_POST['description'])){
					App::error('Veuillez entrer une description.');
				}
			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter une Témoignage
						</h1>
					</div>

					<form action="index.php?page=admin/add-testimony" method="POST">
						<div class="form-group">
							<label for="testimony-author">Auteur</label>
							<input type="text" class="form-control" id="testimony-author" required="required" name="author" placeholder="Auteur">
						</div>

						<div class="form-group">
							<label for="testimony-description">Témoignage</label>
							<input type="text" class="form-control" id="testimony-description" required="required" name="description" placeholder="Description">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
<?php 
	}

	else {
		App::getHeader(404);
	}
?>
