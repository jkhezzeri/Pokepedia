
// Variables initiales pour l'id des types
var id_first_type = 1;
var id_second_type = 0;

// Fonction qui sélectionne le premier type
function changeFirstType(id) {
    // Requête AJAX pour renvoyer le premier type choisi
    $.ajax({
		type: "POST",
		url: "php/change_type.php",
		data: {id: id},
		success: function(result){
			$('#form_first_type_selected').html(result);
		}
	});
    id_first_type = id;

    // Si les deux types sont identiques, on enlève le second type
    if (id_first_type == id_second_type) {
        $('#form_second_type_selected').text('—');
    }

    // Le premier type choisi est enlevé de la liste pour choisir le second type
    $('#form_second_type_list li').css("display", "flex");
    $('[onclick="changeSecondType('+id+')"]').css("display", "none");

}

// Fonction qui sélectionne le second type
function changeSecondType(id) {
    // Si pas de second type
    if (id == 0) {
        $('#form_second_type_selected').text('—');
    // Si second type
    } else {
        // Requête AJAX pour renvoyer le second type choisi
        $.ajax({
    		type: "POST",
    		url: "php/change_type.php",
    		data: {id: id},
    		success: function(result){
    			$('#form_second_type_selected').html(result);
    		}
    	});
    }
    id_second_type = id;
}

// Fonction qui modifie la taille selon la valeur du bouton pressé
function changeHeight(value) {
    // On récupère la taille actuelle
    var height = $('#form_height_value').val().replace(',', '.').replace(' m', '');
    height = parseFloat(height);
    // On modifie la valeur de la taille
    var new_height = height + value;
    // Valeur minimale
    if (new_height < 0) {
        new_height = 0;
    }
    // Valeur maximale
    if (new_height > 999.9) {
        new_height = 999.9;
    }
    // Affichage de la nouvelle taille
    new_height = new_height.toFixed(1);
    new_height = ('000' + new_height).slice(-5);
    new_height = new_height.replace('.', ',');
    $('#form_height_value').val(new_height + ' m');
}

// Fonction qui modifie le poids selon la valeur du bouton pressé
function changeWeight(value) {
    // On récupère le poids actuel
    var weight = $('#form_weight_value').val().replace(',', '.').replace(' kg', '');
    weight = parseFloat(weight);
    // On modifie la valeur du poids
    var new_weight = weight + value;
    // Valeur minimale
    if (new_weight < 0) {
        new_weight = 0;
    }
    // Valeur maximale
    if (new_weight > 999.9) {
        new_weight = 999.9;
    }
    // Affichage du nouveau poids
    new_weight = new_weight.toFixed(1);
    new_weight = ('000' + new_weight).slice(-5);
    new_weight = new_weight.replace('.', ',');
    $('#form_weight_value').val(new_weight + ' kg');
};



// Au lancement de la page
$(document).ready(function () {

    // Types par défaut
    changeFirstType(1);
    changeSecondType(0);

    // Affichage de la liste des types
    $('#form_first_type_selected').on("click", function(){
        $('#form_first_type_list').css("display", "block");
    });
    $('#form_second_type_selected').on("click", function(){
        $('#form_second_type_list').css("display", "block");
    });
    // Ne plus afficher la liste des types
    $(document).on('click', function (e) {
        if ($(e.target).closest("#form_first_type_selected").length === 0) {
            $('#form_first_type_list').css("display", "none");
        }
    });
    $(document).on('click', function (e) {
        if ($(e.target).closest("#form_second_type_selected").length === 0) {
            $('#form_second_type_list').css("display", "none");
        }
    });

    // Affichage de la liste des pokémon dans la partie Évolution
    // dont le texte est présent dans le numéro ou le nom du pokémon
    $('#form_evolution_from').on("focus keyup", function() {
        var text = $(this).val().toLowerCase();
        // Si texte, on affiche la liste des pokémon correspondant au texte
        if ($(this).val()) {
            $('#form_evolution_list').css("display", "block");
            $("#form_evolution_list li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(text) > -1);
            });
        // Pas de texte, on n'affiche pas la liste
        } else {
            $('#form_evolution_list').css("display", "none");
        }
    });
    // Le pokémon sélectionné s'affiche dans le champ de saisie de texte
    $('#form_evolution_list li').on("click", function(){
        $('#form_evolution_from').val($(this).text());
    });
    // Ne plus afficher la liste des pokémon
    $(document).on('click', function (e) {
        if ($(e.target).closest("#form_evolution_from").length === 0) {
            $('#form_evolution_list').css("display", "none");
        }
    });

    // Bouton dans la partie Évolution
    $('#form_evolution_button').on("click", function(){
		if($(this).text() == "►") {
			$(this).text("◄");
		} else if($(this).text() == "◄") {
			$(this).text("►");
		}
	});

    // Remplir dans la partie Évolution si un nom français existe
    $('#form_fr_name input').blur( function() {
        if ($(this).val()) {
            $('#form_evolution_to').val($('#form_number input').val() + " " + $(this).val());
        } else {
            $('#form_evolution_to').val("");
        }
    });
    // Affichage de l'image dans la partie Miniature
    $('#form_miniature textarea').blur( function() {
        $(this).siblings('img').attr('src', $(this).val());
    });
    // Affichage de l'image dans la partie Chromatique
    $('#form_shiny textarea').blur( function() {
        $(this).siblings('img').attr('src', $(this).val());
    });


    // Expression régulière pour la taille et le poids
    var regex = /^\d{0,3}([,]\d)?$/;

    // Variables initiales pour la taille et le poids
    var height = "000,0";
    var weight = "000,0";

    // Enlever l'unité de la taille quand on veut rentrer manuellement une nouvelle taille
    $('#form_height_value').focus( function() {
        $(this).val($(this).val().replace(' m', ''));
        $(this).select();
    });
    // Affichage de la nouvelle taille rentrée manuellement
    $('#form_height_value').blur( function() {
        // Si la taille rentrée vérifie l'expression régulière
        if (regex.test($(this).val())) {
            $(this).val($(this).val().replace(',', '.'));
            var float_height = parseFloat($(this).val()).toFixed(1);
            var new_height = ('000' + float_height).slice(-5);
            $(this).val(new_height.replace('.', ','));
            height = $(this).val();
        // Sinon, on remet l'ancienne taille
        } else {
            $(this).val(height);
        }
        // Remettre l'unité de la taille
        $(this).val($(this).val() + ' m');
    });
    // Enlever l'unité du poids quand on veut rentrer manuellement un nouveau poids
    $('#form_weight_value').focus( function() {
        $(this).val($(this).val().replace(' kg', ''));
        $(this).select();
    });
    // Affichage du nouveau poids rentré manuellement
    $('#form_weight_value').blur( function() {
        // Si le poids rentré vérifie l'expression régulière
        if (regex.test($(this).val())) {
            $(this).val($(this).val().replace(',', '.'));
            var float_weight = parseFloat($(this).val()).toFixed(1);
            var new_weight = ('000' + float_weight).slice(-5);
            $(this).val(new_weight.replace('.', ','));
            weight = $(this).val();
        // Sinon, on remet l'ancien poids
        } else {
            $(this).val(weight);
        }
        // Remettre l'unité du poids
        $(this).val($(this).val() + ' kg');
    });


});
