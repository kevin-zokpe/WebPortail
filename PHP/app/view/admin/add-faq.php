<?php
		$type = $_GET['type'];

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['question']) && isset($_POST['answer'])){

				$question = $_POST['question'];
				$answer = $_POST['answer'];

				PDOConnexion::setParameters('stages', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO faq(question, answer, target)
					VALUES (:question, :answer, :type)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
				$sth->execute(array(
					':question' => $question,
					':answer' => $answer,
					':type' => $type
				));
			
				if ($sth) {
					App::success('Cette question a bien été ajoutée.');
				}
			}

			else {

				if(!isset($_POST['question'])){
					App::error('Veuillez entrer une question.');
				}

				if(!isset($_POST['answer'])){
					App::error('Veuillez entrer une réponse.');
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
							<label for="faq-question">Question</label>
							<input type="text" class="form-control" id="faq-question" name="question" placeholder="Votre question">
						</div>

						<div class="form-group">
							<label for="faq-answer">Réponse</label>
							<input type="text" class="form-control" id="faq-answer" name="answer" placeholder="Votre réponse">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
