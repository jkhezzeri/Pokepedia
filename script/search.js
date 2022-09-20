
// Variables initiales pour le premier et le dernier pokémon d'une génération
var first = 1;
var last = 0;

// Fonction qui affiche la liste des pokémon dans l'ordre choisi
function setSearchSort(id) {
	$('#pokedex_sort_list').children().removeClass('selected');
	$('[onclick="setSearchSort('+id+')"]').addClass('selected');
	// Requête AJAX pour renvoyer la liste des pokémon dans l'ordre choisi
	$.ajax({
		type: "POST",
		url: "php/search.php",
		data: {id: id},
		success: function(result){
			$('#pokedex_results').html(result);
			last = $('#pokedex_results li').length;
			// Appel aux fonctions de filtrage
			visibleText();
			visibleGeneration();
			visibleType();
		}
	});
	// L'ordre choisi est stocké dans la session de navigation
	sessionStorage.setItem('searchSort', id);
};

// Fonction qui change la vue de la liste des pokémon
function setSearchView(id) {
	$('#pokedex_view_buttons').children().removeClass('selected');
	$('[onclick="setSearchView('+id+')"]').addClass('selected');
	if (id==1) {
		$('#pokedex_results').switchClass("list", "grid");
	} else if (id==2) {
		$('#pokedex_results').switchClass("grid", "list");
	}
	// La vue choisie est stockée dans la session de navigation
	sessionStorage.setItem('searchView', id);
	$(window).scrollTop(0);
};


// function setSearchGeneration(id_first, id_last) {
// 	first = id_first;
// 	last = id_last;
// 	$('#pokedex_gen_title').text($('[onclick="setSearchGeneration('+id_first+', '+id_last+')"]').text());
// 	$('#pokedex_results li').each(function() {
// 		var pokeId = $(this).find('.pokedex_pokemon_number').text().substr(3);
// 		while (pokeId.startsWith("0")) {
// 			pokeId = pokeId.substr(1);
// 		}
// 		$(this).toggle(pokeId >= first && pokeId <= last);
// 	});
// 	visibleText();
// 	visibleType();
// };


// Fonction qui retourne la liste des pokémon d'une génération choisie
function setSearchGeneration(id) {
	$('#pokedex_gen_title').text($('[onclick="setSearchGeneration('+id+')"]').text());
	// Toutes les générations
	if (id == 0) {
		$('#pokedex_results li').show();
		// Appel aux fonctions de filtrage autre que la génération
		visibleText();
		visibleType();
	// Une génération en particulier
	} else {
		// Requête AJAX pour récupérer le premier et le dernier pokémon de la génération choisie
		// et retourner les pokémon de la génération choisie
		$.ajax({
			type: "POST",
			url: "php/search_gen.php",
			data: {id: id},
			// dataType: "json",
			success: function(result){
				var gen_range = result.split("-");
				first = parseInt(gen_range[0]);
				last = parseInt(gen_range[1]);
				$('#pokedex_results li').each(function() {
					var pokeId = $(this).find('.pokedex_pokemon_number').text().substr(3);
					$(this).toggle(pokeId >= first && pokeId <= last);
				});
				// Appel aux fonctions de filtrage autre que la génération
				visibleText();
				visibleType();
			}
		});
	}
};

// Variables initiales pour la sélection des types
var countSelectedTypes = 0;
var firstSelectedType = "";
var secondSelectedType = "";

// Fonction qui affiche les pokémon selon le(s) type(s) sélectionné(s)
function setSearchType(type) {
	var selectedType = $('[onclick="setSearchType(\''+type+'\')"]');
	// Si on désélectionne un type
	if (selectedType.hasClass('selected')) {
		selectedType.removeClass('selected');
		countSelectedTypes--;
		// Si on désélectionne le second type
		if (type == secondSelectedType) {
			secondSelectedType = "";
		// Si on désélectionne le premier type
		} else if (type == firstSelectedType) {
			if (secondSelectedType != "") {
				firstSelectedType = secondSelectedType;
				secondSelectedType = "";
			} else {
				firstSelectedType = "";
			}
		}
	// Si on sélectionne un type
	} else {
		// On récupère le(s) type(s) sélectionné(s)
		if (countSelectedTypes < 2) {
			selectedType.addClass('selected');
			countSelectedTypes++;
			if (firstSelectedType == "") {
				firstSelectedType = type;
			} else {
				secondSelectedType = type;
			}
		}
	}
	// Affichage de la liste des pokémon
	// Si aucun type n'est sélectionné
	if (firstSelectedType == "") {
		$('#pokedex_results li').show();
	// Si au moins un type a été sélectionné
	} else {
		// Si un seul type a été sélectionné
		if (secondSelectedType == "") {
			$('#pokedex_results li').each(function() {
				$(this).toggle($(this).find('.type_tag').hasClass(firstSelectedType));
			});
		// Si deux types ont été sélectionnés
		} else {
			$('#pokedex_results li').each(function() {
				$(this).toggle($(this).find('.type_tag').hasClass(firstSelectedType) && $(this).find('.type_tag').hasClass(secondSelectedType));
			});
		}
	}
	// Appel aux fonctions de filtrage autre que les types
	visibleText();
	visibleGeneration();
};

// Fonction qui filtre selon le texte après un premier filtrage
function visibleText() {
	var text = $("#pokedex_search").val().toLowerCase();
	// Si le texte est un nombre
	if ($.isNumeric(text)) {
		$("#pokedex_results li:visible .pokedex_pokemon_number").filter(function() {
			$(this).parent().toggle($(this).text().toLowerCase().indexOf(text) > -1);
		});
	// Si le texte est une chaîne de caractère
	} else {
		$("#pokedex_results li:visible .pokedex_pokemon_name").filter(function() {
			$(this).parent().toggle($(this).text().toLowerCase().indexOf(text) > -1);
		});
	}
};

// Fonction qui filtre selon la génération après un premier filtrage
function visibleGeneration() {
	$('#pokedex_results li:visible').each(function() {
		var pokeId = $(this).find('.pokedex_pokemon_number').text().substr(3);
		while (pokeId.startsWith("0")) {
			pokeId = pokeId.substr(1);
		}
		$(this).toggle(pokeId >= first && pokeId <= last);
	});
};

// Fonction qui filtre selon le(s) type(s) après un premier filtrage
function visibleType() {
	if (firstSelectedType == "") {
		$('#pokedex_results li:visible').show();
	} else {
		if (secondSelectedType == "") {
			$('#pokedex_results li:visible').each(function() {
				$(this).toggle($(this).find('.type_tag').hasClass(firstSelectedType));
			});
		} else {
			$('#pokedex_results li:visible').each(function() {
				$(this).toggle($(this).find('.type_tag').hasClass(firstSelectedType) && $(this).find('.type_tag').hasClass(secondSelectedType));
			});
		}
	}
};



// Au lancement de la page
$(document).ready(function () {
	// On récupère les données stockées dans la session de navigation
	var searchSort = sessionStorage.getItem('searchSort');
	var searchView = sessionStorage.getItem('searchView');
	if ((searchSort && window.location.href.indexOf("modify") <= -1) || (searchView && window.location.href.indexOf("modify") <= -1)) {
		setSearchSort(parseInt(searchSort));
		setSearchView(parseInt(searchView));
	} else if (window.location.href.indexOf("modify") <= -1) {
		setSearchSort(1);
		setSearchView(1);
	}

	// On affiche les pokémon dont le texte est présent dans le numéro ou le nom du pokémon
	$('#pokedex_search').on("keyup", function() {
		var text = $(this).val().toLowerCase();
		// Si le texte est un nombre
        if ($.isNumeric(text)) {
            $("#pokedex_results .pokedex_pokemon_number").filter(function() {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(text) > -1);
            });
		// Si le texte est une chaîne de caractère
        } else {
            $("#pokedex_results .pokedex_pokemon_name").filter(function() {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(text) > -1);
            });
        }
		// Appel aux fonctions de filtrage autre que le texte
		visibleGeneration();
		visibleType();
	});

	// Affichage de la liste des générations
	$('#pokedex_gen').hover(function(){
		$('#pokedex_gen_list').show();
		$('#pokedex_gen_arrow').text("▲");
	}, function() {
		$('#pokedex_gen_list').hide();
		$('#pokedex_gen_arrow').text("▼");
	});

	// Affichage de la recherche avancée
	$('#pokedex_more').click(function(){
		if($("#pokedex_advance_search").hasClass("searchVisible")) {
			$("#pokedex_advance_search").removeClass().addClass("searchHidden");
			$('#pokedex_more').text("Afficher la recherche avancée");
			$('#pokedex_menu').css("height", "50px");
		} else {
			$("#pokedex_advance_search").removeClass().addClass("searchVisible");
			$('#pokedex_more').text("Cacher la recherche avancée");
			$('#pokedex_menu').css("height", "100px");
		}
	});


});
