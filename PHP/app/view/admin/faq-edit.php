<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$faq = Faq::getFaqById($id);

		if (isset($_POST['edit'])) {
			if(isset($_POST['question']) && isset($_POST['answer'])){

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE faq
					SET question = :question,
						answer = :answer,
						target = :target
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
				$sth->execute(array(
					':id' => $id,
					':question' => $_POST['question'],
					':answer' => $_POST['answer'],
					':target' => $_POST['target']
				));
			
				if ($sth) {
					App::success('Cette question a bien été modifiée.');
				}
			}
			else{

				if(!isset($_POST['question']){
					App::error('Veuillez entrer une question.');
				}

				if(!isset($_POST['answer']){
					App::error('Veuillez entrer une réponse.');
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
							<label for="faq-target">Pays</label>
							<select name="target" id="faq-target" class="form-control">
								<option value="" disabled>Choisissez le pays pour lequel la question est destinée</option>
								<option value="student"<?php if ($faq->target == 'student') {echo ' selected';} ?>>Etudiant</option>
								<option value="company"<?php if ($faq->target == 'company') {echo ' selected';} ?>>Entreprise</option>
							</select>
						</div>

						<div class="form-group">
							<label for="faq-question">Questions</label>
							<input type="text" class="form-control" id="faq-question" value="<?php echo $faq->question; ?>" name="question" placeholder="faq-question">
						</div>

						<div class="form-group">
							<label for="faq-answer">Réponse</label>
							<textarea class="form-control" id="faq-answer" name="answer" placeholder="faq-answer"><?php echo $faq->answer; ?></textarea>
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
