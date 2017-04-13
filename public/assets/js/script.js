console.log("debut de projet");

$(function(){
    // CETTE FONCTION SERA APPELEE PAR JQUERY
    // QUAND LA PAGE SERA PRETE

    // JE VEUX BLOQUER LE FONCTIONNEMENT CLASSIQUE DU FORMULAIRE
    // QUI A LA CLASSE .form-ajax
    $(".form-ajax").on("submit", function(event){
        // LE CODE DE CETTE FONCTION EST ACTIVE
        // QUAND LE VISITEUR CLIQUE SUR LE BOUTON SUBMIT

        // https://www.w3schools.com/jsref/event_preventdefault.asp
        // BLOQUER LE FONCTIONNEMENT CLASSIQUE
        event.preventDefault();

        // IL VA FALLOIR FAIRE LE BOULOT A SA PLACE
        // RECUPERER LES INFOS DU FORMULAIRE
        var infosFormulaire = $(this).serialize();

        // BRICOLAGE JS: J'AI BESOIN DU FORMULAIRE ACTIF DANS LA METHODE done
        // MAIS JE NE POURRAI PLUS UTILISER $(this)
        var formActif = $(this);

        // ENVOYER PAR AJAX
        // http://api.jquery.com/jQuery.ajax/
        $.ajax({
            method:     'POST',
            url:        urlAjax,        // ???
            dataType:   'json',
            data:       infosFormulaire
        })
        .done(function(reponseJSON){
            // reponseJSON CONTIENT UN OBJET CREE DANS PHP
            // $reponseJSON = json_encode($tabAssociatif);

            // CODE ACTIVE PLUS TARD EN CAS DE SUCCES
            // (ASYNCHRONE DE LA REQUETE AJAX)
            // DEBUG
            console.log(reponseJSON);
            // JE VEUX AFFICHER LE MESSAGE DANS LA BALISE QUI A LA CLASSE .message
            // BRICOLAGE JS: J'UTILISE LA VARIABLE formActif CREE AVANT L'ENVOI AJAX
            formActif.find(".message").html(reponseJSON.message);
        })
        ;
    });
});

$(function(){
    // CETTE FONCTION SERA APPELEE PAR JQUERY
    // QUAND LA PAGE SERA PRETE

    // JE VEUX BLOQUER LE FONCTIONNEMENT CLASSIQUE DU FORMULAIRE
    // QUI A LA CLASSE .form-ajax
    $(".supp").on("click", function(event){
        // LE CODE DE CETTE FONCTION EST ACTIVE
        // QUAND LE VISITEUR CLIQUE SUR LE BOUTON SUBMIT
        var supp = confirm("êtes vous certain de vouloir supprimer cet administrateur ?")
        if(!supp) //si la personne ne veut pas, je bloque l'action
        {
        event.preventDefault();  // bloque le fonctionnement classique
        }
        // https://www.w3schools.com/jsref/event_preventdefault.asp
        // BLOQUER LE FONCTIONNEMENT CLASSIQUE



    });
});



/////////////// Code JQUERY elodie

(function($) {
    "use strict"; // Start of use strict

    // JQuery pour le scrolling sur la page d'accueil (plugin JQuery Easing)
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize WOW.js Scrolling Animations
    new WOW().init();

})(jQuery); // End of use strict
