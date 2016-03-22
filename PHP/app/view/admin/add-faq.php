<?php
		$type = $_GET['type']; 

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['question_fr']) && isset($_POST['answer_fr']) && isset($_POST['question_en']) && isset($_POST['answer_en'])){

				$question_fr = $_POST['question_fr'];
				$answer_fr = $_POST['answer_fr'];
				$question_en = $_POST['question_en'];
				$answer_en = $_POST['answer_en'];

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO faq(question_fr, answer_fr, question_en, answer_en, target)
					VALUES (:question_fr, :answer_fr, :question_en, :answer_en, :type)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
				$sth->execute(array(
					':question_fr' => $question_fr,
					':answer_fr' => $answer_fr,
					':question_en' => $question_en,
					':answer_en' => $answer_en,
					':type' => $type
				));
			
				if ($sth) {
					$msg->success('Cette question a bien été ajouté.','index.php?page=admin/faq-list');
				}
			}
			
			else {

				if(!isset($_POST['question_fr'])){
					$msg->error('Veuillez entrer une question en français.','index.php?page=admin/add-faq');
				}

				if(!isset($_POST['answer_fr'])){
					$msg->error('Veuillez entrer une réponse en français.','index.php?page=admin/add-faq');
				}

				if(!isset($_POST['question_en'])){
					$msg->error('Veuillez entrer une question en anglais.','index.php?page=admin/add-faq');
				}

				if(!isset($_POST['answer_en'])){
					$msg->error('Veuillez entrer une réponse en anglais.','index.php?page=admin/add-faq');
				}
			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter une Question
						</h1>
					</div>

					<form action="index.php?page=admin/add-faq&amp;type=<?php echo $type; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="faq-question_fr">Question en français</label>
							<input type="text" class="form-control" id="faq-question_fr" required="required" name="question_fr" placeholder="Votre question en français">
						</div>

						<div class="form-group">
							<label for="faq-answer_fr">Réponse en français</label>
							<input type="text" class="form-control" id="faq-answer_fr" required="required" name="answer_fr" placeholder="Votre réponse en français">
						</div>

						<div class="form-group">
							<label for="faq-question_en">Question en anglais</label>
							<input type="text" class="form-control" id="faq-question_en" required="required" name="question_en" placeholder="Votre question en anglais">
						</div>

						<div class="form-group">
							<label for="faq-answer_en">Réponse en anglais</label>
							<input type="text" class="form-control" id="faq-answer_en" required="required" name="answer_en" placeholder="Votre réponse en anglais">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
