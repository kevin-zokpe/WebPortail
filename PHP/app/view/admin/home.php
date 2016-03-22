
<div class="row"> 
	<div class="col-md-12">
		<h1><small> Bonjour admin <?php echo Student::getStudentById($_SESSION['id'])->first_name?> </small></h1>
	</div>
</div>

<div class="row"> 
	<div class="col-md-4">
		<div class="jumbotron">
	  		<h4>Etudiants</h4>
	  		<p> Validés : <b><?php echo count(Student::getActivatedStudents(true)) ?></b><br> En attente : <b><?php echo count(Student::getActivatedStudents(false)) ?></b> </p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/students-list" role="button">afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron"> 
	  		<h4>Entreprises</h4>
	  		<p> Validés : <b><?php echo count(Company::getActivatedCompanies(true))  ?></b> <br> En attente : <b><?php echo count(Company::getActivatedCompanies(false))  ?></b> </p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/companies-list" role="button">afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron">
	  		<h4>Stages</h4>
	  		<p> En france : <b><?php echo count(Internship::getInternshipByCompanyCountry('france')) ?></b> <br> En irlande : <b><?php echo count(Internship::getInternshipByCompanyCountry('irlande')) ?></b></p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/internships-list" role="button">afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron">
	  		<h4>Partenaires</h4> 
	  		<p> En france : <b><?php echo count(Partner::getPartnersByCountry('france')) ?></b> <br> En irlande : <b><?php echo count(Partner::getPartnersByCountry('irlande')) ?></b></p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/partners-list" role="button">afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron">
			<h4>Université : </h4>
	  		<p> En france : <b><?php echo count(Partner::getPartnersUniversityByCountry('france')) ?></b> <br> En irlande : <b><?php echo count(Partner::getPartnersUniversityByCountry('irlande')) ?></b> </p> 
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/partners-list&amp;type=university" role="button">afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron">
			<h4>Questions FAQ :</h4> 
	  		<p> Pour etudiant : <b><?php echo count(Faq::getStudentsFaq()) ?></b> <br> Pour entreprise : <b><?php echo count(Faq::getCompaniesFaq()) ?></b></p>  
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/faq-list&amp;type=student" role="button">afficher la liste</a></p> 
		</div>
	</div>
</div>