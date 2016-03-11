<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<link rel="icon" href="img/favicon.png">
		<title><?php echo App::$siteTitle; ?> - Admin</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php?page=home"><?php echo App::$siteTitle; ?></a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li<?php App::isCurrentPage('home'); ?>><a href="index.php?page=home">Accueil</a></li>
						<li<?php App::isCurrentPage('faq'); ?>><a href="index.php?page=faq">FAQ</a></li>
						<li<?php App::isCurrentPage('archives'); ?>><a href="index.php?page=archives">Archives</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if (App::isLogged()) : ?>
							<?php $member = App::getMember(); ?>
							<?php if (get_class($member) == 'Student') : ?>
								<li class="dropdown">
									<a id="student-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<?php echo $member->first_name; ?>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="student-dropdown">
										<li><a href="index.php?page=profile">Profil</a></li>
										<?php if (App::isAdmin()) : ?>
											<li class="divider" role="separator"></li>
											<li><a href="index.php?page=admin/home">Administration</a></li>
										<?php endif; ?>
									</ul>
								</li>
							<?php endif; ?>
							<li><a href="index.php?page=signout">Déconnexion</a></li>
						<?php else : ?>
							<li class="dropdown">
								<a id="login-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									Me connecter
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="login-dropdown">
									<li><a href="index.php?page=login&amp;type=student">Étudiant</a></li>
									<li><a href="index.php?page=login&amp;type=company">Entreprise</a></li>
								</ul>
							</li>
						<?php endif; ?>
						<li class="dropdown">
							<a id="lang-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								FR
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="lang-dropdown">
								<li><a href="#">EN</a></li>
							</ul>
						</li>
                    </ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li role="presentation"<?php App::isCurrentPage('admin/home'); ?>><a href="index.php?page=admin/home"><i class="fa fa-tachometer"></i> Dashboard</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/students-list'); ?>><a href="index.php?page=admin/students-list"><i class="fa fa-user"></i> Étudiants<?php if (Student::getActivatedStudents(false)) {echo ' <span class="badge">' . count(Student::getActivatedStudents(false)) . '</span>';} ?></a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/companies-list'); ?>><a href="index.php?page=admin/companies-list"><i class="fa fa-building"></i> Entreprises</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/internships-list'); ?>><a href="index.php?page=admin/internships-list"><i class="fa fa-briefcase"></i> Stages</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/faq-list'); ?>><a href="index.php?page=admin/faq-list"><i class="fa fa-question-circle"></i> FAQ</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/testimonials-list'); ?>><a href="index.php?page=admin/testimonials-list"><i class="fa fa-quote-left"></i> Témoignages</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/partners-list'); ?>><a href="index.php?page=admin/partners-list"><i class="fa fa-link"></i> Partenaires</a></li>
						<li role="presentation"<?php App::isCurrentPage('admin/settings'); ?>><a href="index.php?page=admin/settings"><i class="fa fa-cog"></i> Réglages</a></li>
					</ul>
				</div>
			</div>

			<div class="row">
