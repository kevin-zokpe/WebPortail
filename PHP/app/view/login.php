<?php
	if (!App::isLogged()) {
		if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['type'])) {
			try {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$type = $_POST['type'];

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();

				if ($type == 'student') {
					$sql = "SELECT id, password, activated FROM student WHERE email = :email";
					$sth = $db->prepare($sql);
					$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
					$sth->execute(array(
						':email' => $email
					));
				}

				elseif ($type == 'company') {
					$sql = "SELECT id, password, activated FROM company WHERE email = :email";
					$sth = $db->prepare($sql);
					$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
					$sth->execute(array(
						':email' => $email
					));
				}

				else {
					App::redirect('index.php?page=home');
				}

				$member = $sth->fetch();

				if ($member) {
					if (Bcrypt::checkPassword($password, $member->password)) {
						if ($member->activated) {
							if ($member->id > 0) {
								$_SESSION['id'] = $member->id;
								$_SESSION['email'] = $email;
								$_SESSION['type'] = $type;
							}

							App::redirect('index.php?page=home');
						}

						else {
							$msg->error('Votre compte n\'a pas encore été confirmé par l\'administrateur.','index.php?page=login');
						}
					}

					else {
						$msg->error('Identifiants incorrects !','index.php?page=login');
					}
				}

				else {
					$msg->error('Cet utilisateur n\'existe pas','index.php?page=login');
				}
			}

			catch(PDOException $e) {
				echo 'Erreur de connexion : ' . $e->getMessage() . '<br />';
				die();
			}
		}

		else {
			if (isset($_GET['type']) && !empty($_GET['type']) && ($_GET['type'] == 'student' || $_GET['type'] == 'company')) {
				$type = htmlentities($_GET['type']);

				if ($type == 'student') {
					$otherType = 'company';
					$asOther = 'en tant qu\'entreprise';
				}

				else {
					$otherType = 'student';
					$asOther = 'en tant qu\'étudiant';
				}
?>

<style type="text/css">
	.form-signin {
	    margin: 0 auto;
	    max-width: 330px;
	    padding: 15px;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
			  <h1>
			  	Connexion
			  	<small>
			  	<?php
				  	if ($type == 'student') {
				  		echo '<small>en tant qu\'étudiant</small>';
				  	}

				  	else {
				  		echo '<small>en tant qu\'entreprise</small>';
				  	}
			  	?>
			  	</small>
			  </h1>
			</div>
			<form class="form-signin" method="POST" action="index.php?page=login">
				<p>
					<label class="sr-only" for="inputEmail">Adresse email</label>
					<input type="email" placeholder="Adresse email" class="form-control" id="inputEmail" name="email" autofocus required />
				</p>
				<p>
					<label class="sr-only" for="inputPassword">Mot de passe</label>
					<input type="password" placeholder="Mot de passe" class="form-control" id="inputPassword" name="password" required />
				</p>
				<p style="font-size: 12px; margin-bottom: 30px;">
					<a href="index.php?page=register-<?php echo $type; ?>">Je veux m'inscrire</a> | <a href="index.php?page=login&amp;type=<?php echo $otherType; ?>">Me connecter <?php echo $asOther; ?></a>
				</p>
				<p>
					<input type="hidden" name="type" value="<?php echo $type; ?>" />
					<button type="submit" class="btn btn-lg btn-primary btn-block">Me connecter</button>
				</p>
			</form>
		</div>
	</div>
</div>
<?php
			}

			else {
				App::redirect('index.php?page=home');
			}
		}
	}

	else {
		App::redirect('index.php?page=home');
	}
?>