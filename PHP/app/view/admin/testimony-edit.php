<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$testimony = Testimony::getTestimonyById($id);

		if (isset($_POST['edit'])) {
			if (isset($_POST['description']) && isset($_POST['author']) && preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author'])) {
				$edit = Testimony::editTestimony($id, $_POST['description'], $_POST['author']);
			
				if ($edit) {
					$msg->success('Ce témoignage a bien été modifié.','index.php?page=admin/testimonials-list');
				}
			}

			else {
				if (!isset($_POST['description'])) {
					$msg->error('Veuillez entrer une description.', 'index.php?page=admin/testimony-edit' . $id);
				}

				if (!isset($_POST['author']) || !preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author'])) {
					$msg->error("Veuillez entrer un nom d'auteur valide.", 'index.php?page=admin/testimony-edit' . $id);
				}
			}
		}

		if ($testimony) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer le témoignage : <br/>
						</h1>
					</div>

					<form action="index.php?page=admin/testimony-edit&amp;id=<?php echo $id; ?>" method="POST">

						<div class="form-group">
							<label for="testimony-author">Auteur</label>
							<input type="text" class="form-control" id="testimony-author" required="required" value="<?php echo $testimony->author; ?>" name="author" placeholder="Auteur">
						</div>

						<div class="form-group">
							<label for="testimony-description">Témoignage</label>
							<textarea class="form-control" id="testimony-description" required="required" name="description" placeholder="Description"><?php echo $testimony->description; ?></textarea>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/testimony-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/testimony-list');
	}
?>
