<?php
	if (!isset($_GET['type']) || $_GET['type'] != 'awaiting') {
		$_GET['type'] = 'activated';
	}

	$type = htmlentities($_GET['type']);
?>
<div class="col-md-12">
	<div class="page-header">
		<h1>
			Liste des entreprises
			<?php
				if ($type == 'awaiting') {
					echo '<small>En attente d\'activation</small>';
					echo '<a href="index.php?page=admin/companies-list&amp;type=activated" class="btn btn-primary pull-right">Voir les entreprises confirmées <span class="badge">' . count(Company::getActivatedCompanies(true)) . '</span></a>';
				}

				else {
					echo '<small>Confirmées</small>';
					echo '<a href="index.php?page=admin/companies-list&amp;type=awaiting" class="btn btn-primary pull-right">En attente de confirmation <span class="badge">' . count(Company::getActivatedCompanies(false)) . '</span></a>';
				}
			?>
		</h1>
	</div>
	
	<?php
		if ($type == 'activated') :
			if (Company::getActivatedCompanies(true)) :
	?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Email</th>
				<th>Pays</th>
				<th>Ville</th>
				<th>Description</th>
				<th>URL</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php
			foreach (Company::getActivatedCompanies() as $company) {
				echo '<tr>';
					echo '<td>' . $company->name . '</td>';
					echo '<td>' . $company->email . '</td>';
					echo '<td>' . $company->country . '</td>';
					echo '<td>' . $company->city . '</td>';
					echo '<td>' . $company->description . '</td>';
					echo '<td>' . $company->website . '</td>';
					echo '<td><a href="index.php?page=admin/company-edit&amp;id=' . $company->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
			else:
				echo 'Aucune entreprise n\'a été confirmée.';
			endif;
		else:
			if (Company::getActivatedCompanies(false)) :
	?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Pays</th>
					<th>Compétence</th>
					<th>Email</th>
					<th>Portfolio</th>
					<th>Date d'inscription</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php
				foreach (Company::getActivatedCompanies(false) as $company) {
					echo '<tr>';
						echo '<td>' . $company->name . '</td>';
						echo '<td>' . $company->email . '</td>';
						echo '<td>' . $company->country . '</td>';
						echo '<td>' . $company->city . '</td>';
						echo '<td>' . $company->description . '</td>';
						echo '<td>' . $company->website . '</td>';
						echo '<td>' . $company->register_date . '</td>';
						echo '<td><a href="index.php?page=admin/company-edit&amp;id=' . $company->id . '"><i class="fa fa-check" data-toggle="tooltip" title="Activer"></i></a></td>';
						echo '<td><a><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
						echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	<?php
			else:
				echo 'Aucune entreprise n\'est en attente de confirmation.';
			endif;
		endif;
	?>
</div>
