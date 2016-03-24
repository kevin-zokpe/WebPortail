<nav class="navbar">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php?page=home"><?php echo Settings::getWebsiteName(); ?></a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li<?php App::isCurrentPage('home'); ?>><a href="index.php?page=home"><?php echo $language->translate('home'); ?></a></li>
				<li<?php App::isCurrentPage('faq'); ?>><a href="index.php?page=faq"><?php echo $language->translate('faq'); ?></a></li>
				<li<?php App::isCurrentPage('testimonials'); ?>><a href="index.php?page=testimonials"><?php echo $language->translate('testimonials'); ?></a></li>
				<li class="dropdown"
					<?php App::isCurrentPage('formations-france'); App::isCurrentPage('formations-ireland'); ?>>
				  	<a id="formations-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						Formations
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="member-dropdown">
						<li><a href="index.php?page=formations-france">France</a></li>
						<li><a href="index.php?page=formations-ireland">Irlande</a></li>
					</ul>
				</li>
				<?php if (App::isLogged()) : ?>
					<?php $member = App::getMember(); ?>
						<li class="dropdown member">
							<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
								<img src="img/icons/member.svg" alt="Membre">
								<?php echo $member->first_name; ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="member-dropdown">
								<?php if (get_class($member) == 'Student') : ?>
									<li><a href="index.php?page=profile-student">Profil</a></li>
									<li><a href="index.php?page=internship-request">Ma recherche de stage</a></li>
									<li><a href="index.php?page=find-internship">Rechercher un stage</a></li>
									<li><a href="index.php?page=find-company">Rechercher une entreprise</a></li>
									<?php if (App::isAdmin()) : ?>
										<li class="divider"></li>
										<li><a href="index.php?page=admin/home">Administration</a></li>
									<?php endif; ?>
								<?php else : ?>
									<li><a href="index.php?page=profile-company">Profil</a></li>
									<li><a href="index.php?page=my-internships">Stages proposés</a></li>
									<li><a href="index.php?page=find-student">Rechercher des étudiants</a></li>
								<?php endif; ?>
								<li class="divider"></li>
								<li><a href="index.php?page=signout">Déconnexion</a></li>
							</ul>
						</li>
				<?php else : ?>
					<li class="dropdown member">
						<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><img src="img/icons/member.svg" alt="Membre"> Me connecter <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="login-dropdown">
							<li><a href="index.php?page=login&amp;type=student">Étudiant</a></li>
							<li><a href="index.php?page=login&amp;type=company">Entreprise</a></li>
						</ul>
					</li>
				<?php endif; ?>
				<li class="dropdown language">
					<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="language-flag <?php echo $language->getCurrentLanguage()['code']; ?>"></span>
						<?php echo $language->getCurrentLanguage()['name']; ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="index.php?page=<?php echo $_GET['page']; ?>&amp;lang=<?php echo $language->getOtherLanguage()['code']; ?>"><span class="language-flag <?php echo $language->getOtherLanguage()['code']; ?>"></span><?php echo $language->getOtherLanguage()['name']; ?></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="overlay"></div>