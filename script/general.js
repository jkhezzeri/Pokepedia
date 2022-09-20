
// Au lancement de la page
$(document).ready(function () {

	// Bouton pour revenir en haut de la page
	$(window).scroll(function() {
		if ($(document).scrollTop() > 1) {
			$("#button_top").css("display", "block");
		} else {
			$("#button_top").css("display", "none");
		}
	});

});
