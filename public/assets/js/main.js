$(function () {
    //Messages flash
    window.setTimeout(function () {
        $("#alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

    //Vérification publication/modification article
    var erreur = 0;

    function cadre(champ, erreur) {
        if (erreur) {
            champ.style.border = '1px solid red';
        } else {
            champ.style.border = "";
        }
    }

    function avertissement(champ, alerte) {
        if (alerte) {
            champ.style.border = '1px solid orange';
        } else {
            champ.style.border = "";
        }
    }

    $('#titre').focus(function () {
        $('#msgTitre').fadeOut(2000, function () {
            $('#msgTitre').remove();
        })
    })

    $('#titre').blur(function verifTitre() {
        if (this.value == "") {
            cadre(this, true);
            $('#titre').after('<div id="msgTitre"></div>');
            $('#msgTitre').load('../app/Views/erreurs/msgErreur.html #erreurTitre');
        } else {
            cadre(this, false);
            $('#msgTitre').remove();
        }
    })

    $('#categorie').focus(function () {
        $('#msgCategorie').fadeOut(2000, function () {
            $('#msgCategorie').remove();
        })
    })

    $('#categorie').blur(function verifCategorie() {
        if (this.value == "") {
            avertissement(this, true);
            $('#categorie').after('<div id="msgCategorie"></div>');
            $('#msgCategorie').load('../app/Views/erreurs/msgErreur.html #erreurCategorie');
        } else {
            cadre(this, false);
            $('#msgCategorie').remove();
        }
    })

    $('#dateMsg').focus(function () {
        $('#msgDateMsg').fadeOut(2000, function () {
            $('#msgDateMsg').remove();
        })
    })

    $('#dateMsg').blur(function verifDateMsg() {
        if (this.value == "") {
            avertissement(this, true);
            $('#dateMsg').after('<div id="msgDateMsg"></div>');
            $('#msgDateMsg').load('../app/Views/erreurs/msgErreur.html #erreurDateMsg');
        } else {
            cadre(this, false);
            $('#msgDateMsg').remove();
        }
    })

    $('#auteur').focus(function () {
        $('#msgAuteur').fadeOut(2000, function () {
            $('#msgAuteur').remove();
        })
    })

    $('#auteur').blur(function verifAuteur() {
        if (this.value == "") {
            cadre(this, true);
            $('#auteur').after('<div id="msgAuteur"></div>');
            $('#msgAuteur').load('../app/Views/erreurs/msgErreur.html #erreurAuteur');
        } else {
            cadre(this, false);
            $('#msgAuteur').remove();
        }
    })

    $('#message').focus(function () {
        $('#msgMessage').fadeOut(2000, function () {
            $('#msgMessage').remove();
        })
    })

    $('#message').blur(function verifMessage() {
        if (this.value == "") {
            cadre(this, true);
            $('#message').after('<div id="msgMessage"></div>');
            $('#msgMessage').load('../app/Views/erreurs/msgErreur.html #erreurMessage');
        } else {
            cadre(this, false);
            $('#msgMessage').remove();
        }
    })

    $('#submit').click(function verifForm() {
        if ($('#titre').val() == "" || $('#auteur').val() == "" || $('#message').val() == "") {
            alert("Veuillez remplir correctement tous les champs");
            $('.form-control').each(function () {
                cadre(this, true);
            })
            return false;
        }
        else {
            return true;
        }
    })

//Vérification publication commentaire
    $('#comm').focus(function () {
        $('#msgComm').fadeOut(2000, function () {
            $('#msgComm').remove();
        })
    })

    $('#comm').blur(function () {
        if (this.value == "") {
            cadre(this, true);
            $('#comm').after('<div id="msgComm"></div>');
            $('#msgComm').load('../app/Views/erreurs/msgErreur.html #erreurComm');
        } else {
            cadre(this, false);
            $('#msgComm').remove();
        }
    })

    $('#submit').click(function verifAjoutComm() {
        if ($('#comm').val() == "") {
            alert("Veuillez remplir correctement tous les champs");
            $('.form-control').each(function () {
                cadre(this, true);
            })
            return false;
        }
        else {
            return true;
        }
    })

    //Ouvrir dynamiquement l'accordéon
    var current = window.location.hash;
    var findToggler = $('#accordeon a[href$="' + current + '"]').parent('h3');

    var indexToggler;
    if (findToggler.length) {
        indexToggler = findToggler.index('h3');
    } else {
        indexToggler = 0;
    }

    $('#accordeon').accordion({
        heightStyle: "content",
        active: indexToggler
    })


})

