<div class="col-md-12">
	<div class="page-header">
		<h1>Réglages du site</h1>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Réglage</th>
				<th>Valeur</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (Settings::getSettingsList() as $setting) {
					if ($setting->value == 'true') {
						$setting->value = '<i class="fa fa-check" style="color: #27ae60;"></i>';
					}

					if ($setting->value == 'false') {
						$setting->value = '<i class="fa fa-times" style="color: #e74c3c;"></i>';
					}

					echo '<tr>';
						echo '<td>' . $setting->placeholder . '</td>';
						echo '<td>' . $setting->value . '</td>';
						echo '<td><a href="index.php?page=admin/setting-edit&amp;id=' . $setting->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
</div>