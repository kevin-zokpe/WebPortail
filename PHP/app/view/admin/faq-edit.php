<?php
	if (isset($_GET['id']) && !empty($_GET['id']) && App::isAdmin()) {
		$id = htmlentities($_GET['id']);
		$faq = Faq::getFaqById($id);

		if (isset($_POST['edit'])) {
			if (isset($_POST['question']) && !empty($_POST['question']) && isset($_POST['answer']) && !empty($_POST['answer'])) {
				$edit = Faq::editFaq($id, $_POST['question'], $_POST['answer'], $_POST['target']);

				if ($edit) {
					$msg->success('Cette question a bien été modifiée.', 'index.php?page=admin/faq-list&type=' . $faq->target);
				}
			}

			else {
				if (!isset($_POST['question']) || empty($_POST['question'])) {
					$msg->error('Veuillez entrer une question.', 'index.php?page=admin/faq-edit&id=' . $id);
				}

				if (!isset($_POST['answer']) || empty($_POST['answer'])) {
					$msg->error('Veuillez entrer une réponse.', 'index.php?page=admin/faq-edit&id=' . $id);
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
							<label for="faq-question">Question</label>
							<input type="text" class="form-control" id="faq-question" value="<?php echo $faq->question; ?>" name="question" placeholder="Votre question" required>
						</div>

						<div class="form-group">
							<label for="faq-answer">Réponse</label>
							<textarea class="form-control" id="faq-answer" name="answer" placeholder="Réponse de votre question" required><?php echo $faq->answer; ?></textarea>
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
