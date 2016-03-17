<?php

	if (isset($_POST['add'])) {
		if (isset($_POST['testimony']) && !empty($_POST['testimony'])) {

			$member = App::getMember();

			if($_GET['type']=='student'){
				$name = $member->first_name . ' ' . $member->last_name;
			}

			if($_GET['type']=='company'){
				$name = $member->name;
			}
    	    	    
			try {
				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO testimony(description, author, register_date)
					VALUES (:description, :author, NOW())
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
				$sth->execute(array(
					':description' => $_POST['testimony'],
					':author' => $name,
				));

				App::redirect('index.php?page=testimonials');
			}
			catch(PDOException$e) {
				echo '<p>Erreur : ' . $e->getMessage() . '</p>';
				die();
			}
		}
		else {
			App::error('Veuillez rédiger votre témoignage !');
		}
	}
?>
<style type="text/css">
	form .row {
		margin-bottom: 20px;
	}
</style>

<div class="container">
	<div class="page-header">
		<h1>
			Témoignage
			<small>Partagez votre expérience</small>
		</h1>
	</div>

	<div class="row">
		<div class="col-md-8">
			<form name="login" method="POST" action="index.php?page=create-testimony&amp;type=<?php echo $_GET['type']; ?>">
				<div class="row">
					<div class="col-md-12">
						<label for="testimony">Rédigez votre témoignage</label>
						<textarea type="text" name="testimony" class="form-control" required="required" id="testimony" placeholder="Votre témoignage" data-validation="length" data-validation-error-msg="Rédigez votre témoignage !"></textarea>
					</div>
				</div>

				<input type="submit" name="add" class="btn btn-primary" value="Ajouter">
			</form>
		</div>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
