<style>
	.admin-panel {
		text-align: center;
	}

	.admin-panel h4 {
		text-transform: uppercase;
		font-weight: 700;
		font-size: 28px;
	}
</style>

<div class="row"> 
	<div class="col-md-4">
		<div class="admin-panel jumbotron">
	  		<h4>Étudiants</h4>
	  		<p>
	  			Validés : <strong><?php echo count(Student::getActivatedStudents(true)); ?></strong><br />
	  			En attente : <strong><?php echo count(Student::getActivatedStudents(false)) ?></strong>
	  		</p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/students-list" role="button">Afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="admin-panel jumbotron"> 
	  		<h4>Entreprises</h4>
	  		<p>
	  			Validés : <strong><?php echo count(Company::getActivatedCompanies(true)); ?></strong><br />
	  			En attente : <strong><?php echo count(Company::getActivatedCompanies(false))  ?></strong>
	  		</p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/companies-list" role="button">Afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="admin-panel jumbotron">
	  		<h4>Stages</h4>
	  		<p>
	  			En France : <strong><?php echo count(Internship::getInternshipByCompanyCountry('france')); ?></strong><br />
	  			En Irlande : <strong><?php echo count(Internship::getInternshipByCompanyCountry('irlande')); ?></strong>
	  		</p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/internships-list" role="button">Afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="admin-panel jumbotron">
	  		<h4>Partenaires</h4> 
	  		<p>
	  			En France : <strong><?php echo count(Partner::getPartnersByCountry('france')); ?></strong><br />
	  			En Irlande : <strong><?php echo count(Partner::getPartnersByCountry('irlande')); ?></strong>
	  		</p>
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/partners-list" role="button">Afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="admin-panel jumbotron">
			<h4>Universités</h4>
	  		<p>
	  			En France : <strong><?php echo count(Partner::getPartnersUniversityByCountry('france')); ?></strong><br />
	  			En Irlande : <strong><?php echo count(Partner::getPartnersUniversityByCountry('irlande')); ?></strong>
	  		</p> 
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/partners-list&amp;type=university" role="button">Afficher la liste</a></p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="admin-panel jumbotron">
			<h4>Questions FAQ</h4> 
	  		<p>
	  			Pour étudiant : <strong><?php echo count(Faq::getStudentsFaq()) ?></strong><br />
	  			Pour entreprise : <strong><?php echo count(Faq::getCompaniesFaq()); ?></strong>
	  		</p>  
	  		<p><a class="btn btn-info-outline btn-sm" href="index.php?page=admin/faq-list&amp;type=student" role="button">Afficher la liste</a></p> 
		</div>
	</div>
</div>