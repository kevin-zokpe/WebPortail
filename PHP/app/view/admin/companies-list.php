<div class="col-md-12">
	<div class="page-header">
		<h1>Liste des entreprises</h1>
	</div>
	
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
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
			foreach (Company::getCompaniesList() as $company) {
				echo '<tr>';
					echo '<td>' . $company->id . '</td>';
					echo '<td>' . $company->name . '</td>';
					echo '<td>' . $company->email . '</td>';
					echo '<td>' . $company->country . '</td>';
					echo '<td>' . $company->city . '</td>';
					echo '<td>' . $company->description . '</td>';
					echo '<td>' . $company->website . '</td>';
					echo '<td><a href="index.php?page=admin/company-edit&amp;id=' . $company->id . '"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>