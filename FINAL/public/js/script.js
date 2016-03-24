window.jQuery = window.$ = jQuery;

$(window).load(function() {
	homeHeight();
});

$(window).resize(function() {
	homeHeight();
});

function homeHeight() {
	$('#home-slider, #slider .slides li').css('height', $(window).height());
}

$(window).load(function() {
	$('#slider').flexslider({
		animation: "fade",
		slideshowSpeed: 3500,
		pauseOnAction: false,
		pauseOnHover: false,
		controlNav: false,
		directionNav: false,
		prevText: "",
		nextText: ""
	});
});

$(document).ready(function() {
	$('.scroll').click(function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop: $(this.hash).offset().top}, 1000);
		
		return false;
	});

	$('.navbar-toggle').click(function() {
		$('.overlay').toggleClass('show');
		$(this).toggleClass('open');
	});

	$("input[name$='optionsRadios']").click(function () {
		$('#post-request').submit();
	});

	$('#find-internship select[name="skill"]').change(function() {
		var selectedSkill = $(this).val();
		var country = $(this).attr('data-country');

		$.getJSON(
			"public/webservice/internships.php", {"skill": selectedSkill, "country": country}, function(result) {
				if (result.no_result) {
					$('#results').html('Aucun stage disponible dans ce domaine');
				}

				else {
					var table = '<table class="table table-striped"><thead><tr><th>Entrepise</th><th>Poste</th><th>Mission</th><th>Adresse</th><th>Ville</th><th>Code postal</th><th></th><th></th></tr></thead><tbody>';
					
					for (i = 0; i < result.length; i++) {
						var internshipInfo = result[i];
						table += '<tr><td><a href="index.php?page=view-profile-company&id=' + internshipInfo.id_company + '">' + internshipInfo.company + '</a></td><td>' + internshipInfo.name + '</td><td>' + internshipInfo.description + '</td><td>' + internshipInfo.address + '</td><td>' + internshipInfo.city + '</td><td>' + internshipInfo.zip_code + '</td>' + '<td><i class="fa fa-envelope"></i> <a href="mailto:' + internshipInfo.email + '">Contacter</a></td>' + '<td><i class="fa fa-file-text"></i> <a href="index.php?page=internship-info&id=' + internshipInfo.id + '">Voir la fiche</a></td>';
					}

					table += '</tbody></table>';
					$("#results").html(table);
				}
			}
		)
	});

	$('#find-student select[name="skill"]').change(function() {
		var selectedSkill = $(this).val();
		var country = $(this).attr('data-country');

		$.getJSON(
			"public/webservice/students.php", {"skill": selectedSkill, "country": country}, function(result) {
				if (result.no_result) {
					$('#results').html('Aucun étudiant.');
				}

				else {
					var table = '<table class="table table-striped"><thead><tr><th>Nom</th><th>Prénom</th><th>Pays</th><th>Compétence</th><th>Email</th><th>Portfolio</th><th>Date d\'inscription</th><th></th></tr></thead><tbody>';
					
					for (i = 0; i < result.length; i++) {
						var studentInfo = result[i];
						table += '<tr><td>' + studentInfo.last_name + '</td><td>' + studentInfo.first_name + '</td><td>' + studentInfo.country + '</td><td>' + studentInfo.skill + '</td><td><a href="mailto:' + studentInfo.email + '">' + studentInfo.email + '</a></td><td><a href="'+studentInfo.portfolio+'" target="_blank">' + studentInfo.portfolio + '</a></td><td>' + studentInfo.register_date + '</td><td><i class="fa fa-envelope"></i> <a href="mailto:' + studentInfo.email + '">Contacter</a></td><td><i class="fa fa-user"></i> <a href="index.php?page=view-profile-student&id=' + studentInfo.id + '">Voir le profil</a></td></tr>';
					}

					table += '</tbody></table>';
					$("#results").html(table);
				}
			}
		)
	});
});