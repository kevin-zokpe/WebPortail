<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron" style="text-align: center;">
				<h1>Web Portal</h1>
				<?php
					if (!App::isLogged()) {
				?>
				<p>Me connecter en tant que :</p>
				<p>
					<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=student" role="button">Étudiant</a>
					<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=company" role="button">Entreprise</a>
				</p>
			</div>
			<?php
				}

				else {
					echo Student::countStudentsInternshipRequest() . ' étudiants sont en recherche de stage';
				}
			?>
		</div>
	</div>
</div>