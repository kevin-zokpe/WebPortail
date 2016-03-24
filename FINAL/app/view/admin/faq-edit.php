<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$faq = Faq::getFaqById($id);

		if (isset($_POST['edit'])) {
			if (isset($_POST['question_fr']) && !empty($_POST['question_fr']) && isset($_POST['answer_fr']) && !empty($_POST['answer_fr']) &&
				isset($_POST['question_en']) && !empty($_POST['question_en']) && isset($_POST['answer_en']) && !empty($_POST['answer_en'])) {
				$edit = Faq::editFaq($id, $_POST['question_fr'], $_POST['answer_fr'], $_POST['question_en'], $_POST['answer_en'], $_POST['target']);

				if ($edit) {
					$msg->success('Cette question a bien été modifiée.', 'index.php?page=admin/faq-list&type=' . $faq->target);
				}
			}

			else {
				if (!isset($_POST['question_fr']) || empty($_POST['question_fr'])) {
					$msg->error('Veuillez entrer une question en français.', 'index.php?page=admin/faq-edit&id=' . $id);
				}

				if (!isset($_POST['answer_fr']) || empty($_POST['answer_fr'])) {
					$msg->error('Veuillez entrer une réponse en français.', 'index.php?page=admin/faq-edit&id=' . $id);
				}

				if (!isset($_POST['question_en']) || empty($_POST['question_en'])) {
					$msg->error('Veuillez entrer une question en anglais.', 'index.php?page=admin/faq-edit&id=' . $id);
				}

				if (!isset($_POST['answer_en']) || empty($_POST['answer_en'])) {
					$msg->error('Veuillez entrer une réponse en anglais.', 'index.php?page=admin/faq-edit&id=' . $id);
				}
			}
		}

		if ($faq) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Éditer la question : <br/>
							<small><?php echo $faq->question; ?></small>
						</h1>
					</div>

					<form action="index.php?page=admin/faq-edit&amp;id=<?php echo $id; ?>" method="POST">

						<div class="form-group">
							<label for="faq-target">Cible</label>
							<select name="target" id="faq-target" required="required" class="form-control">
								<option value="" disabled>Choisissez le type de personne pour laquelle la question est destinée</option>
								<option value="student"<?php if ($faq->target == 'student') {echo ' selected';} ?>>Etudiant</option>
								<option value="company"<?php if ($faq->target == 'company') {echo ' selected';} ?>>Entreprise</option>
							</select>
						</div>

						<div class="form-group">
							<label for="faq-question_fr">Question en français</label>
							<input type="text" class="form-control" id="faq-question_fr" value="<?php echo $faq->question_fr; ?>" name="question_fr" placeholder="Votre question en français" required>
						</div>

						<div class="form-group">
							<label for="faq-answer_fr">Réponse en français</label>
							<textarea class="form-control" id="faq-answer_fr" name="answer_fr" placeholder="Réponse de votre question en français" required><?php echo $faq->answer_fr; ?></textarea>
						</div>

						<div class="form-group">
							<label for="faq-question_en">Question en anglais</label>
							<input type="text" class="form-control" id="faq-question_en" value="<?php echo $faq->question_en; ?>" name="question_en" placeholder="Votre question en anglais" required>
						</div>

						<div class="form-group">
							<label for="faq-answer_en">Réponse en anglais</label>
							<textarea class="form-control" id="faq-answer_en" name="answer_en" placeholder="Réponse de votre question en anglais" required><?php echo $faq->answer_en; ?></textarea>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/faq-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/faq-list');
	}
?>
