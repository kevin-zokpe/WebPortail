<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$setting = Settings::getSettingById($id);

		if (isset($_POST['edit'])) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE settings
				SET value = :value
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute(array(
				':id' => $id,
				':value' => $_POST[$setting->tag]
			));
			
			if ($sth) {
				$msg->success('Le réglage "' . lcfirst($setting->placeholder) . '" a bien été modifié.', 'index.php?page=admin/settings-list');
			}
		}

		if ($setting) :
?>
				<div class="col-md-12">
					<div class="page-header">
						<h1>
							Réglages
							<a href="index.php?page=admin/settings-list" class="btn btn-primary pull-right">Voir tous les réglages</a>
						</h1>
					</div>

					<form action="index.php?page=admin/setting-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
							<label for="student-last-name"><?php echo $setting->placeholder; ?></label>
							<?php
								if ($setting->data_type == 'boolean') {
									$activatedTrue = ($setting->value == 'true') ? ' checked' : '';
									$activatedFalse = ($setting->value == 'true') ? '' : ' checked';

									echo '
										<div class="radio">
											<label>
												<input type="radio" name="' . $setting->tag . '" id="' . $setting->tag . '_true" value="true" ' . $activatedTrue . '>
												Je veux être alerté.
											</label>
										</div>

										<div class="radio">
											<label>
												<input type="radio" name="' . $setting->tag . '" id="' . $setting->tag . '_false" value="false" ' . $activatedFalse . '>
												Je ne veux pas être alerté.
											</label>
										</div>
									';
								}

								else {
									echo '<input type="text" class="form-control" id="' . $setting->tag . '" required="required" value="' . $setting->value . '" name="' . $setting->tag . '" placeholder="' . $setting->placeholder . '">';
								}
							?>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/students-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/students-list');
	}
?>
