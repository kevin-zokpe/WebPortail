<?php
	if (App::isAdmin()) {
?>
<div class="col-md-12">
	<div class="page-header">
		<h1>
			Liste des Témoignages
		</h1>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Auteur</th>
				<th>Témoignage</th>
				<th>Date</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php
			foreach (Testimony::getTestimonialsList() as $testimony) {
				echo '<tr data-id="' . $testimony->id . '">';
					echo '<td>' . $testimony->author . '</td>';
					echo '<td>' . $testimony->description . '</td>';
					echo '<td>' . $testimony->register_date . '</td>';
					echo '<td><a href="index.php?page=admin/testimony-edit&amp;id=' . $testimony->id . '" data-toggle="tooltip" title="Modifier"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<a href="index.php?page=admin/add-testimony" class="btn btn-primary">Ajouter un témoignage</a>
	<?php
	}
	else{
		App::getHeader(404);
	}
	?>
</div>

<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/testimony-delete.php',
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
