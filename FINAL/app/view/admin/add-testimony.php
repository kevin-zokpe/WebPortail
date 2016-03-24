<?php
	if (App::isAdmin()) {
		if (isset($_POST['add']) && App::isAdmin()) {
			if (isset($_POST['author']) && !empty($_POST['author']) && preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author']) && isset($_POST['description']) && !empty($_POST['description'])){
				$author = htmlentities($_POST['author']);
				$description = htmlentities($_POST['description']);

				$add = Testimony::addTestimony($author, $description);
			
				if ($add) {
					$msg->success('Ce témoignage a bien été ajouté', 'index.php?page=admin/testimonials-list');
				}
			}
			
			else {
				if (!isset($author) || empty($author) || !preg_match("#^[a-zA-Z0-9._-]{2,64}#", $author)){
					$msg->error('Veuillez entrer un nom d\'auteur valide.', 'index.php?page=admin/add-testimony');
				}

				if (!isset($description) || empty($description)){
					$msg->error('Veuillez entrer une description.', 'index.php?page=admin/add-testimony');
				}
			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>Ajouter un témoignage</h1>
					</div>

					<form action="index.php?page=admin/add-testimony" method="POST">
						<div class="form-group">
							<label for="testimony-author">Auteur</label>
							<input type="text" class="form-control" id="testimony-author" required="required" name="author" placeholder="Auteur">
						</div>

						<div class="form-group">
							<label for="testimony-description">Témoignage</label>
							<textarea class="form-control" id="testimony-description" name="description" placeholder="Description" required></textarea>
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
