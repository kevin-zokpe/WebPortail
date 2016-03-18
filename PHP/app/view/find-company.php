<?php if (App::isStudent()) : ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1>
						Rechercher une entreprise
					</h1>
				</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Logo</th>
							<th>Email</th>
							<th>Pays</th>
							<th>Ville</th>
							<th>Description</th>
							<th>Site Internet</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					
					<?php
						foreach (Company::getActivatedCompanies() as $company) {
							echo '<tr data-id=' . $company->id . '>';
								echo '<td>' . $company->name . '</td>';
								echo '<td><img alt="Aucun" src="' . $company->logo . '" style="width:40px;"/></td>';
								echo '<td><a href="mailto:' . $company->email . '">' . $company->email . '</a></td>';
								echo '<td>' . $company->country . '</td>';
								echo '<td>' . $company->city . '</td>';
								echo '<td>' . $company->description . '</td>';
								echo '<td><a href="' . $company->website . '" target="_blank">' . $company->website . '</a></td>';
								echo '<td><i class="fa fa-envelope"></i> <a href="mailto:' . $company->email . '">Contacter</a></td>';
								echo '<td><i class="fa fa-user"></i> <a href="index.php?page=view-profile-company&id=' . $company->id . '">Voir le profil</a></td>';
							echo '</tr>';
						}
					?>
				</table>
			</div>
		</div>
	</div>
<?php
	else:
		App::getHeader(404);
	endif;
?>
