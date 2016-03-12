<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$testimony = Testimony::getTestimonyById($id);

		if (isset($_POST['edit'])) {
			if(isset($_POST['description']) && isset($_POST['author']) && preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author'])){

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE testimony
					SET description = :description,
						author = :author
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Testimony');
				$sth->execute(array(
					':id' => $id,
					':description' => $_POST['description'],
					':author' => $_POST['author']
				));
			
				if ($sth) {
					App::success('Ce témoignage a bien été modifiée.');
				}
			}
			else{

				if(!isset($_POST['description'])){
					App::error('Veuillez entrer une description.');
				}

				if(!isset($_POST['author']) || !preg_match("#^[a-zA-Z0-9._-]{2,64}#", $_POST['author'])){
					App::error("Veuillez entrer un nom d'auteur valide.");
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
							<input type="text" class="form-control" id="testimony-author" value="<?php echo $testimony->author; ?>" name="author" placeholder="Auteur">
						</div>

						<div class="form-group">
							<label for="testimony-description">Témoignage</label>
							<textarea class="form-control" id="testimony-description" name="description" placeholder="Description"><?php echo $testimony->description; ?></textarea>
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
