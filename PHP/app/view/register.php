<?php
	if (!App::isLogged()) {
		if (!isset($_GET['type']) || $_GET['type'] != 'company') {
			$_GET['type'] = 'student';
		}

		$type = htmlentities($_GET['type']);

		if ($type == 'student') {
			if (isset($_POST['register'])) {
				if (isset($_POST['first_name']) && !empty($_POST['first_name']) && preg_match("#^[a-zA-Z]{2,32}$#", $_POST['first_name']) &&
		    		isset($_POST['last_name']) && !empty($_POST['last_name']) && preg_match("#^[a-zA-Z]{2,32}$#", $_POST['last_name']) &&
		    		isset($_POST['email']) && !empty($_POST['email']) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
		    		isset($_POST['email-confirm']) && $_POST['email-confirm'] == $_POST['email'] &&
		    		isset($_POST['password']) && !empty($_POST['password']) && preg_match("#^\w{8,}$#", $_POST['password']) &&
		    		isset($_POST['password-confirm']) && $_POST['password-confirm'] == $_POST['password'] &&
		    		isset($_POST['country'] ) && !empty($_POST['country']) &&
		    		isset($_POST['skill']) && !empty($_POST['skill']) &&
		    		/*
		    		isset($_FILES['cv']) &&
		    		isset($_POST['portfolio']) && $_POST['portfolio']!="" && preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $POST['portfolio']) &&
		    		*/
		    		isset($_POST['accept_terms'])
		    	) {
		    	    
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$country = $_POST['country'];
					$skill = $_POST['skill'];
					$portfolio = $_POST['portfolio'];
		    	    
		    	    
					try {
						PDOConnexion::setParameters('stages', 'root', 'root');
						$db = PDOConnexion::getInstance();
						$sql = "
							INSERT INTO student(first_name, last_name, country, skill, email, password, portfolio, admin, available, activated, register_date)
							VALUES (:first_name, :last_name, :country, :skill, :email, :password, :portfolio, false, false, DATE())
						";
						$sth = $db->prepare($sql);
						$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
						$sth->execute(array(
							':first_name' => $first_name,
							':last_name' => $last_name,
							':country' => $country,
							':skill' => $skill,
							':email' => $email,
							':password' => Bcrypt::hashPassword($password),
							':portfolio' => $portfolio
						));
						if (isset($_FILES['cv'])) {
		          			$dossier = 'assets/uploads/cv/' . $last_name . '-' . $first_name;
		          			$fichier = basename($_FILES['cv']['name']);
		          			move_uploaded_file($_FILES['cv']['tmp_name'], $dossier . '/' . $fichier);
		        		}

						App::redirect('Location: index.php?page=home');
					}

					catch(PDOException$e) {
						echo '<p>Erreur : ' . $e->getMessage() . '</p>';
						die();
					}
				}

				else {
					App::error('Vous devez remplir tous les champs obligatoires !');
				}
			}

			if (isset($_POST['register'])) {

		if(isset($_POST['first_name']) && $_POST['first_name']!="" && preg_match("#^[a-zA-Z]{2,32}$#", $_POST['first_name']) &&
    		isset($_POST['last_name']) && $_POST['last_name']!="" && preg_match("#^[a-zA-Z]{2,32}$#", $_POST['last_name']) &&
    		isset($_POST['email']) && $_POST['email']!="" && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
    		isset($_POST['email-confirm']) && $_POST['email-confirm']==$_POST['email'] &&
    	   	isset($_POST['password']) && $_POST['password']!="" && preg_match("#^\w{8,}$#", $_POST['password']) &&
    	   	isset($_POST['password-confirm']) && $_POST['password-confirm']==$_POST['password'] &&
    	   	isset($_POST['country'] ) && $_POST['country']!="" &&
    	   	isset($_POST['skill']) && $_POST['skill']!="" &&
    	   	/*isset($_FILES['cv']) &&
    	   	isset($_POST['portfolio']) && $_POST['portfolio']!="" && 
    	   		preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $POST['portfolio']) && */
    	   	isset($_POST['accept_terms'])){
    	    
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$country = $_POST['country'];
			$skill = $_POST['skill'];
			$portfolio = $_POST['portfolio'];
    	    
    	    
			try{
				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO student(`first_name`, `last_name`, `country`, `skill`, `email`, `password`, `portfolio`)
							VALUES (:first_name, :last_name, :country, :skill, :email, :password, :portfolio)";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
				$sth->execute(array(
					':first_name' => $first_name,
					':last_name' => $last_name,
					':country' => $country,
					':skill' => $skill,
					':email' => $email,
					':password' => Bcrypt::hashPassword($password),
					':portfolio' => $portfolio
				));

				if(isset($_FILES['cv'])){
          			$dossier = "assets/uploads/cv/".$last_name.'-'.$first_name;
          			$fichier = basename($_FILES['cv']['name']);
          			move_uploaded_file($_FILES['cv']['tmp_name'], $dossier . '/' . $fichier);
        		}

				header("location:index.php?page=home");
			}
			catch(PDOException$e){
				echo"<p>Erreur:".$e->getMessage()."</p>";
				die();
			}
		}
		else{
			App::error('Vous devez remplir tous les champs obligatoires');
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
			Inscription
			<small>En tant qu'étudiant</small>
		</h1>
	</div>
	<h1>Inscription</h1>

	<div class="row">
		<div class="col-md-8">
			<form name="login" method="POST" action="index.php?page=register">
				<div class="row">
					<div class="col-md-6">
						<label for="signup-firstname">Prénom</label>
						<input type="text" name="first_name" class="form-control" id="signup-firstname" placeholder="Prénom" data-validation="length" data-validation-length="2-20"  data-validation-error-msg="Entrez votre prenom !">
					</div>

					<div class="col-md-6">
						<label for="signup-lastname">Nom</label>
						<input type="text" name="last_name" class="form-control" id="signup-lastname" placeholder="Nom" data-validation="length" data-validation-length="2-30"  data-validation-error-msg="Entrez votre nom !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email">Adresse email</label>
						<input type="text" name="email" class="form-control" id="signup-email" placeholder="Adresse email" data-validation="email"  data-validation-error-msg="Adresse mail invalide !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email-confirm">Confirmez votre adresse email</label>
						<input type="text" name="email-confirm" class="form-control" id="signup-email-confirm" placeholder="Confirmez votre adresse email" data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg="L'adresse ne correspond pas à celle saisie plus haut !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-password">Mot de passe</label>
						<input type="password" name="password" class="form-control" id="signup-password" placeholder="Mot de passe (8 caractères minimum)" data-validation="length" data-validation-length="min8" data-validation-error-msg="Le mot de passe doit contenir 8 charactères alphanumérique au minimum !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-password-confirm">Confirmez votre mot de passe</label>
						<input type="password" name="password-confirm" class="form-control" id="signup-password-confirm" placeholder="Confirmez votre mot de passe" data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Le mot de passe ne correspond pas à celui saisi plus haut !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-country">Pays</label>
						<select name="country" id="signup-country" class="form-control">
							<option value="" disabled selected>Choisissez votre pays</option>
							<option value=""></option>
							<option value="France">France</option>
							<option value="Irlande">Irlande</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-skill">Domaine de compétences</label>
						<select name="skill" id="signup-skill" class="form-control">
							<option value="" disabled selected>Choisissez votre domaine de compétences</option>
							<?php
								foreach (Skill::getSkillsList() as $skill) {
									echo '<option value="' . $skill->id . '">' . $skill->name . '</option>';
								}
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-cv">CV</label>
						<input type="file" name="cv" id="signup-cv" placeholder="CV"  data-validation-error-msg="Vous devez insérer un CV !">
					</div>

					<div class="col-md-6">
						<label for="signup-portfolio">Portfolio</label>
						<input type="text" name="portfolio" class="form-control" id="signup-portfolio" placeholder="Portfolio" data-validation="length" data-validation-length="16-128" data-validation-error-msg="Vous devez entrer un site web !">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-terms">Conditions d'utilisation</label>
						<textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at quam eget dolor mattis dapibus sit amet in ante. Nunc mattis euismod dapibus. Nunc ullamcorper finibus metus dapibus tristique. Maecenas malesuada bibendum metus, quis lacinia nisl consectetur in. In nec ex ac nulla sagittis tempus sed eu sem. Maecenas ac tortor eu justo volutpat tincidunt. Etiam commodo magna consequat risus pharetra, at interdum velit congue. Morbi sed leo congue, placerat libero ut, pretium lorem. Fusce maximus nisl eu lectus lacinia malesuada. Ut placerat eget odio eget commodo. Duis venenatis tincidunt blandit. Ut vitae hendrerit massa. Donec elementum semper dolor quis varius. Nam sollicitudin lacus vel elit porttitor mollis.</textarea>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="accept_terms" id="signup-terms" data-validation="required" data-validation-error-msg="Vous devez accepter les conditions d'utilisations !">
								J'ai lu et j'accepte les <a href="#">conditions d'utilisations</a> et la <a href="#">politique de confidentialité</a> de PhoneDeals.
							</label>
						</div>
					</div>
				</div>

				<input type="submit" name="register" class="btn btn-primary" value="S'inscrire">
			</form>
            
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
                modules : 'security'
            }); </script>-->
		</div>
	</div>
</div>
<?php
		}

		else {
			echo '<h1 style="text-align: center;">Page inscription entreprise à faire</h1>';
		}
	}

	else {
		App::redirect('index.php?page=home');
	}
?>
            
		</div>
	</div>
</div>