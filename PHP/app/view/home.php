<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Web Portal</h1>
			<?php
				if (!App::isLogged()) {
			?>
			<p>Me connecter en tant que :</p>
			<ul>
				<li><a href="index.php?page=login&amp;type=student">Étudiant</a></li>
				<li><a href="index.php?page=login&amp;type=company">Entreprise</a></li>
			</ul>
			<?php
				}

				else {
					echo 'Bonjour';
				}
			?>
		</div>
	</div>
</div>