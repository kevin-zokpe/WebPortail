<div id="home-slider">
	<a href="#about" class="scroll down"><i class="fa fa-angle-down"></i></a>

	<div class="container">
		<div class="home-content">
			<h2 class="home-title"><span>Internship</span> Web Portal</h2>
			<?php
				if (!App::isLogged()) {
			?>
				<span class="login-type">Je suis</span>
				<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=student" data-hover="Je me connecte"><span><?php echo $language->translate('student'); ?></span></a>
				<a class="btn btn-primary btn-lg" href="index.php?page=login&amp;type=company" data-hover="Je me connecte"><span><?php echo $language->translate('company'); ?></span></a>
			<?php
				}
			?>
			<div id="partners">
				<?php
					foreach (Partner::getPartnersList('university') as $university) {
						echo '<img src="' . $university->logo . '" alt="' . $university->name . '">';
					}
				?>
			</div>
		</div>
	</div>

	<div id="slider">
		<ul class="slides">
			<li class="slide1"></li>
			<li class="slide2"></li>
			<li class="slide3"></li>
		</ul>
	</div>
</div>

<div id="about" class="section-content">
	<div class="container">
		<div class="section-title">
			<h2>À propos</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut tellus enim. Aenean id mi porttitor, commodo sem a, rutrum erat.</p>
		</div>
		<div id="about-content" class="row">
			<div class="about-case col-md-4 col-sm-6">
				<div class="about-icon">
					<img src="img/icons/europe.svg" alt="Europe">
				</div>
				<div class="about-description">
					<h4>Un stage ailleurs en Europe</h4>
					<p>Ce portail a pour but de favoriser la mobilité étudiante dans le cadre du Programme Erasmus +.</p>
					<p>Les entreprises partenaires pourront contacter et être contactées par des étudiants, en fonction de leurs compétences, et les accueillir en stage.</p>
				</div>
			</div>
			<div class="about-case col-md-4 col-md-offset-4 col-sm-6">
				<div class="about-icon">
					<img src="img/icons/plane.svg" alt="Avion">
				</div>
				<div class="about-description">
					<h4>En France et en Irlande</h4>
					<p>Plusieurs protagonistes participent à cette plateforme :</p>
					<ul>
						<li>L'IUT Cherbourg Manche (Normandie, France)</li>
						<li>Letterkenny IT (Donegal, Irlande)</li>
						<li>Other school ? (Irlande)</li>
					</ul>
				</div>
			</div>
			<div class="about-case col-md-4 col-sm-6">
				<div class="about-icon">
					<img src="img/icons/student.svg" alt="Étudiant">
				</div>
				<div class="about-description">
					<h4>Étudiants et entreprises</h4>
					<p>Ce portail s'adresse aux étudiants de l'IUT Cherbourg-Manche, de Letterkenny IT et aux entreprises partenaires.</p>
					<p>Si vous souhaitez rejoindre notre plateforme, vous pouvez prendre contact avec les personnes responsables de ce projet.</p>
				</div>
			</div>
			<div class="about-case col-md-4 col-md-offset-4 col-sm-6">
				<div class="about-icon">
					<img src="img/icons/login.svg" alt="Connexion">
				</div>
				<div class="about-description">
					<h4>Inscription très simple</h4>
					<p>Pour vous inscrire sur ce portail, remplissez le formulaire d'inscription.</p>
					<p>Vous pourrez alors chercher un stage, déposer une proposition de stage, consulter le profil d'étudiants, contacter une entreprise partenaire ou un étudiant.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="available-internships">
	<div id="internships-ireland">
		<img src="img/icons/ireland-shape.svg" alt="Irlande">
		<div class="available-text">
			<strong>3</strong>
			stages disponibles
			<small>en Irlande</small>
		</div>
	</div>
	<div id="internships-france">
		<img src="img/icons/france-shape.svg" alt="France">
		<div class="available-text">
			<strong>5</strong>
			stages disponibles
			<small>en France</small>
		</div>
	</div>
</div>

<div id="partners" class="section-content">
	<div class="container">
		<div class="section-title">
			<h2>Partenaires</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut tellus enim. Aenean id mi porttitor, commodo sem a, rutrum erat.</p>
		</div>
		<div class="row">
			<?php
				foreach (Partner::getPartnersList('company') as $partner) {
					echo '<div class="partner-case col-md-2 col-sm-2"><img src="' . $partner->logo . '" alt="' . $partner->name . '"></div>';
				}
			?>
		</div>
	</div>
</div>