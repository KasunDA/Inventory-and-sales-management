$( document ).ready( function () {
	
	$( "#nom0, #nom1, #nom2, #nom3, #nom4" ).autocomplete({
		source: liste
	});

	$( "#client").autocomplete({
		source: listeclient
	});
	
	// this section is the form validator of the application
	$( "#gestion" ).validate( {
		rules: {
			nom: { required: true, minlength: 2 },
			prenom: { required: true, minlength: 2 },
			localite: { required: true, minlength: 2 },
			tel: { required: true, number: true, minlength: 9, maxlength: 9 },
			tel1: { required: true, number: true, minlength: 9, maxlength: 9 },
			pass: { required: true, minlength:5},
			pass1: { required: true, equalTo: "#pass" },
			cat: { required: true,  minlength: 2},
			libelle: { required: true,  minlength: 2},
			codeP: { required: true, minlength: 4},
			quantite: {required: true, number: true, min:1 },
			poids: {required: true, number: true, min:1 },
			prix: {required: true, number: true, min:1 },
			prixC1: {required: true, number: true, min:1 },
			prixC2: {required: true, number: true, min:1 },
			prixC3: {required: true, number: true, min:1 },
			prixC4: {required: true, number: true, min:1 }
		},	
		messages: {
			nom: { 
				required: "SVP Entrez un nom valide", 
				minlength: "Votre nom doits contenire au moins 2 charactères"
			},
			prenom: { 
				required: "SVP Entrez un prenom valide", 
				minlength: "Votre prenom doits contenire au moins 2 charactères"
			},
			localite: { 
				required: "SVP Entrez une localité valide", 
				minlength: "Votre localité doits contenire au moins 2 charactères"
			},
			tel: { 
				required: "SVP Entrez un numéro de téléphone valide",
				minlength: "Votre numéro de téléphone doits contenire au moins 9 charactères",
				maxlength: "Votre numéro de téléphone doits contenire au plus 9 charactères",
				number: "Entrez un numéro de téléphone valide"
			},
			tel1: { 
				required: "SVP Entrez un numéro de téléphone valide",
				minlength: "Votre numéro de téléphone doits contenire au moins 9 charactères",
				maxlength: "Votre numéro de téléphone doits contenire au plus 9 charactères",
				number: "Entrez un numéro de téléphone valide"
			},
			pass: { 
				required: "SVP Entrez un mot de passe valide",
				minlength: "Votre mot de passe doits contenire au moins 5 charactères"
			},
			pass1: {
				required: "SVP Entrez un mot de passe valide",
				equalTo: "Entrez un mot de passe indentique"
			},
			cat: {
				required: "Ce champ est obligatoire",
				minlength: "Ce champ doits contenire au moins 2 charactères"
			},
			libelle: {
				required: "Ce champ est obligatoire",
				minlength: "Ce champ doits contenire au moins 2 charactères"
			},
			codeP: {
				required: "Ce champ est obligatoire",
				minlength: "Ce champ doits contenire au moins 4 charactères"
			},
			quantite: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			poids: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			prix: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			prixC1: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			prixC2: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			prixC3: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			},
			prixC4: {
				required: "Ce champ est obligatoire",
				min: "Entrer un nombre >= 0",
				number: "Entrer un nombre valide"
			}
						
		},	
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents( ".col-sm-8" ).addClass( "has-feedback" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !element.next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
			}
		},
		success: function ( label, element ) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !$( element ).next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-8" ).addClass( "has-error" ).removeClass( "has-success" );
			$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-8" ).addClass( "has-success" ).removeClass( "has-error" );
			$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
		}
	
	});
});