<!DOCTYPE html>
<html lang="<?php echo $language->getCurrentLanguage()['code']; ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo Settings::getWebsiteDescription(); ?>">
		<link rel="icon" href="img/favicon.png">
		<title><?php echo Settings::getWebsiteName(); ?></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php
			if ($msg->hasMessages()) {
				$msg->display();
			}

			require_once(APP . '/view/navbar.php');
		?>

		<header id="header">
		    <div class="section-title admin">
		        <h1>Administration</h1>
				<div class="container">
					<div class="row">
						<ul class="nav nav-tabs"> 
							<li role="presentation"<?php App::isCurrentPage('admin/home'); ?>><a href="index.php?page=admin/home"><i class="fa fa-tachometer"></i> Dashboard</a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/students-list'); ?>><a href="index.php?page=admin/students-list"><i class="fa fa-user"></i> Étudiants<?php if (Student::getActivatedStudents(false)) {echo ' <span class="badge">' . count(Student::getActivatedStudents(false)) . '</span>';} ?></a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/companies-list'); ?>><a href="index.php?page=admin/companies-list"><i class="fa fa-building"></i>Entreprises <?php if (Company::getActivatedCompanies(false)) {echo ' <span class="badge">' . count(Company::getActivatedCompanies(false)) . '</span>';} ?></a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/internships-list'); ?>><a href="index.php?page=admin/internships-list"><i class="fa fa-briefcase"></i> Stages </a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/faq-list'); ?>><a href="index.php?page=admin/faq-list"><i class="fa fa-question-circle"></i> FAQ</a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/testimonials-list'); ?>><a href="index.php?page=admin/testimonials-list"><i class="fa fa-quote-left"></i> Témoignages</a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/partners-list'); ?>><a href="index.php?page=admin/partners-list"><i class="fa fa-link"></i> Partenaires</a></li>
							<li role="presentation"<?php App::isCurrentPage('admin/settings-list'); ?>><a href="index.php?page=admin/settings-list"><i class="fa fa-cog"></i> Réglages</a></li>
						</ul>
					</div>
				</div>
			</div>
		</header>

		<div id="admin-content" class="section-content">
		    <div class="container">
		        <div class="row">