<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron" style="text-align: center;">
				<h1>Web Portal</h1>
				<?php
					foreach (Partner::getPartnersList('university') as $university) {
						echo '<div style="margin-bottom: 30px;"><img src="' . $university->logo . '" alt="' . $university->name . '" style="height: 30px;"></div>';
					}

					if (!App::isLogged()) {
				?>
				<p>Me connecter en tant que :</p>
				<p>
					<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=student" role="button"><?php echo $language->translate('student'); ?></a>
					<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=company" role="button"><?php echo $language->translate('company'); ?></a>
				</p>
				<?php
					}

					else {
						echo Student::countStudentsInternshipRequest() . ' étudiants sont en recherche de stage';
					}
				?>
			</div>
		</div>
	</div>

	<div class="row">
		<?php
			foreach (Partner::getPartnersList('company') as $partner) {
				echo '<div class="col-md-2"><img src="' . $partner->logo . '" alt="' . $partner->name . '" style="height: 70px;"></div>';
			}
		?>
	</div>
</div>
