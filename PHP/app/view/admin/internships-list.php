<?php
	if (!isset($_GET['country']) && App::isAdmin()) {
		App::redirect('index.php?page=admin/internships-list&country=France');
	}
	
	$country = ($_GET['country'] == 'France') ? 'France' : 'Irlande';
?>
<div class="col-md-12">
	<div class="page-header">
		<h1>
			Stages disponibles en
			<?php
				if ($country == 'France') {
					echo '<small> France </small>';
					echo '<a href="index.php?page=admin/internships-list&country=Irlande" class="btn btn-primary pull-right">Voir la liste des stages en Irlande</a>';
				}

				else {
					echo '<small>Irlande</small>';
					echo '<a href="index.php?page=admin/internships-list&country=France" class="btn btn-primary pull-right">Voir la liste des stages en France</a>';
				}
			?>
		</h1>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Entreprise</th>
				<th>Poste</th>
				<th>Description</th>
				<th>Domaine</th>
				<th>Adresse</th>
				<th>Ville</th>
				<th>Code postale</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if ($country == 'France') {
					foreach (Internship::getInternshipByCompanyCountry($country) as $internship) {
						echo '<tr data-id="' . $internship->id . '">';
							echo '<td>' . Company::getCompanyById($internship->company)->name . '</td>';
							echo '<td>' . $internship->name . '</td>';
							echo '<td>' . $internship->description . '</td>';
							echo '<td>' . Skill::getSkillById($internship->skill)->name . '</td>';
							echo '<td>' . $internship->address . '</td>';
							echo '<td>' . $internship->city . '</td>';
							echo '<td>' . $internship->zip_code . '</td>';
							echo '<td><a href="index.php?page=admin/internship-edit&amp;country='. $country .'&amp;id=' . $internship->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
							echo '<td><a href="#" title="Supprimer" data-action="delete"><i class="fa fa-trash"  data-toggle="tooltip" title="Supprimer"></i></a></td>';
						echo '</tr>';
					}
				}

				else {
					foreach (Internship::getInternshipByCompanyCountry($country) as $internship) {
					echo '<tr data-id="' . $internship->id . '">';
							echo '<td>' . Company::getCompanyById($internship->company)->name . '</td>';
							echo '<td>' . $internship->name . '</td>';
							echo '<td>' . $internship->description . '</td>';
							echo '<td>' . Skill::getSkillById($internship->skill)->name . '</td>';
							echo '<td>' . $internship->address . '</td>';
							echo '<td>' . $internship->city . '</td>';
							echo '<td>' . $internship->zip_code . '</td>';
							echo '<td><a href="index.php?page=admin/internship-edit&amp;country='. $country .'&amp;id=' . $internship->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
							echo '<td><a href="#" title="Supprimer" data-action="delete"><i class="fa fa-trash"  data-toggle="tooltip" title="Supprimer"></i></a></td>';
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>
	<a href="index.php?page=admin/add-internship&amp;country=<?php echo $country; ?>" class="btn btn-primary">Ajouter un stage</a>
</div>

<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/internship-delete.php',
			{'delete': true, 'id': $(this).parent().parent().data('id')},
			'deleteRow'
		);
	});

	var eAjaxData = '';

	function eAjax(url, parameters, callback) {
	    if (!confirm('Êtes-vous sûr ?')) {
	        return false;
	    }

	    $.post(url, parameters, function(data) {
	        eAjaxData = data;
	        var func = callback + "()";
	        eval(func);
	    }, "json");
	}

	function deleteRow() {
	    if (eAjaxData.status == 'true') {
	        $('[data-id="' + eAjaxData.id + '"]').fadeTo('slow', 0.01).slideUp('slow');
	    }
	    
	    else {
	        alert(eAjaxData.status);
	    }
	}
</script>
