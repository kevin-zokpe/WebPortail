<?php
	if (App::isAdmin()) :
		if (!isset($_GET['type']) || $_GET['type'] != 'university') {
			$_GET['type'] = 'company';
		}

		$type = htmlentities($_GET['type']);
?>
	<div class="col-md-12">
		<div class="page-header">
			<h1>
				Liste des partenaires
				<?php
					if ($type == 'university') {
						echo '<small>Universités</small>';
						echo '<a href="index.php?page=admin/partners-list&amp;type=company" class="btn btn-primary pull-right">Voir les entreprises</a>';
					}

					else {
						echo '<small>Entreprises</small>';
						echo '<a href="index.php?page=admin/partners-list&amp;type=university" class="btn btn-primary pull-right">Voir les universités</a>';
					}
				?>
			</h1>
		</div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Logo</th>
					<th>Nom</th>
					<th>Pays</th>
					<th>Date</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php
				foreach (Partner::getPartnersList($type) as $partner) {
					echo '<tr data-id=' . $partner->id . '>';
						echo '<td><img alt="' . $partner->name . '" src="' . $partner->logo . '" style="width:80px;"/></td>';
						echo '<td>' . $partner->name . '</td>';
						echo '<td>' . $partner->country . '</td>';
						echo '<td>' . $partner->register_date . '</td>';	
						echo '<td><a href="index.php?page=admin/partner-edit&amp;id=' . $partner->id . '" data-toggle="tooltip" title="Modifier"><i class="fa fa-pencil"></i></a></td>';
						echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
		<a href="index.php?page=admin/add-partner" class="btn btn-primary">Ajouter un partenaire</a>
	</div>

	<script>
		$('[data-action="delete"]').click(function(e) {
			e.preventDefault();

			eAjax(
				'public/webservice/admin/partner-delete.php',
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
<?php
	else :
		App::getHeader(404);
	endif;
?>
