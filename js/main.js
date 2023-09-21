$(document).ready(function() {
    // Login
    $('#login').click(function() {
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        $.ajax({
            type: 'POST',
            url: '../inc/function-login.php',
            data: { email: email, password: password},
            success: function(data) {
                if( data == 'loginOk') {
                    window.location.replace("area-riservata");
                } else if( data == 'errorPass') {
                    swal("OPS!", "Password errata", "error");
                } else {
                    swal("OPS!", "Username non trovato", "error");
                }                    
            },
            error: function() {
                alert('Errore nella richiesta AJAX' + data);
            }
        });
    });
    // Registrati
    $('#register').click(function() {
        let email = $('input[name="email"]').val();
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();

        $.ajax({
            type: 'POST',
            url: '../inc/function-register.php',
            data: { email: email, username: username, password: password},
            success: function(data) {
                //alert(data);
                window.location.href = "login?messaggio=Utente+registrato+con+successo%21";
            },
            error: function() {
                alert('Errore nella richiesta AJAX' + data);
            }
        });
    });
    // Cambia pass utente
    $('#changePass').click(function() {
        let old_password = $('input[name="old_password"]').val();
        let new_password = $('input[name="new_password"]').val();
        let confirm_password = $('input[name="confirm_password"]').val();
        if ( new_password != confirm_password ) {
            swal("OPS!", "Le password non corrispondono", "error");
            return;
        }
        $.ajax({
            type: 'POST',
            url: '../inc/cambia-password.php',
            data: {
                old_password: old_password,
                new_password: new_password,
                confirm_password: confirm_password
            },
            success: function(data) {
                if (data === 'passChart') {
                    swal("OPS!", "La password deve contenere almeno 8 caratteri e una lettera maiuscola!", "error");
                } else if(data === 'passOk') {
                    swal("Ottimo!", "Password modificata con successo", "success");
                    $('input[name="old_password"').val('');
                    $('input[name="new_password"').val('');
                    $('input[name="confirm_password"').val('');
                } else {
                    swal("OPS!", "Qualcosa è andato storto", "error");
                    console.log(data);
                } 
            },
            error: function() {
                swal("OPS!", "Qualcosa è andato storto", "error");
                console.log(data);
            }
        });
    });
    // Cambia email utente
    $('#changeEmail').click(function() {
        let new_email = $('input[name="new_email"]').val();
        $.ajax({
            type: 'POST',
            url: '../inc/cambia-email.php',
            data: {
                new_email: new_email,
            },
            success: function(data) {
                if (data === 'emailInUso') {
                    swal("OPS!", "Questa email è già in uso", "error");
                } else if(data === 'emailOk') {
                    swal("Ottimo!", "Email modificata con successo", "success");
                } else {
                    swal("OPS!", "Qualcosa è andato storto", "error");
                    console.log(data);
                } 
            },
            error: function() {
                swal("OPS!", "Qualcosa è andato storto", "error");
                console.log(data);
            }
        });
    });
    // Aggiungi il capitolo
    $('#aggiungi').click(function() {
        let titolo = $('input[name="titolo"]').val();
        let contenuto = $('textarea[name="contenuto"]').val();
        let formData = new FormData();
        formData.append('titolo', titolo);
        formData.append('contenuto', contenuto);
        $.ajax({
            type: 'POST',
            url: '../inc/inserisci_capitolo.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data === 'successo') {
                    swal("Ottimo!", "Capitolo caricato con successo con successo", "success")
                    .then(() => {
                        $('input[name="titolo"]').val('');
                        $('textarea[name="contenuto"]').val('');
                        location.reload();
                    });
                } else {
                    swal("OPS!", "Capitolo non caricato"+data, "error");
                }
            },
            error: function() {
                console.error('Errore nella richiesta AJAX');
            }
        });
    });
    // Modifica il capitolo
    $('#aggiornaCap').click(function() {
        let id = $('input[name="id"]').val();
        let titolo = $('input[name="titolo"]').val();
        let contenuto = $('textarea[name="contenuto"]').val();
        $.ajax({
            type: 'POST',
            url: '../inc/processo-modifica.php',
            data: { id: id, titolo: titolo, contenuto: contenuto },
            success: function(data) {
                if (data === 'success') {
                    swal("Ottimo!", "Capitolo modificato con successo", "success")
                    .then(() => {
                        window.location.replace("scrivi-libro");
                    });
                } else {
                    swal("OPS!", "Capitolo non caricato"+data, "error");
                }
            },
            error: function() {
                console.error('Errore nella richiesta AJAX');
            }
        });
    });
    // Gestisci il click del pulsante per modificare
    $("#formMod").submit(function(event) {
        let selectedOption = $("select[name='update_cap']").val();
        if (selectedOption === null || selectedOption === "") {
            event.preventDefault(); // Previeni l'invio del modulo
            swal("OPS!", "Devi selezionare un capito per continuare", "error");
        }
    });
    // Gestisci il click del pulsante per eliminare capitoli
    $('#eliminaCapitolo').click(function() {
        let idsToDelete = $('select[name="delete_cap"]').val();    
        if (idsToDelete === null) {
            swal("OPS!", "Devi selezionare un capito per continuare", "error");
            return;
        }
        swal({
            title: "Sei sicuro?",
            text: "L'eliminazione del capitolo sarà irreversibile",
            icon: "warning",
            buttons: ["Annulla", "Prosegui"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../inc/elimina-capitoli.php', // Percorso relativo corretto
                    data: { idsToDelete: idsToDelete },
                    success: function(data) {
                        swal("Ottimo!", "Capitolo eliminato con successo", "success")
                        .then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        alert('Errore nella richiesta AJAX');
                    }
                });
            } else {
                return
            }
        });

    });    
    // Chiude gli alert e fa un refresh della URL
    $(".close").click(function(){
        history.replaceState({}, document.title, window.location.pathname);
    });
    // Sistema Tabs
    $("a[data-toggle='tab']").click(function() {
        let tabId = $(this).attr("id");
        $(".tab-pane").removeClass("active");
        $(".nav-link").removeClass("active");
        $("#" + tabId).addClass("active");
        $("#" + tabId + "-content").addClass("active");
    });
    $("a[data-target='submenu']").click(function() {
        $("#submenu").toggleClass('show animate');                  
    });
    //  Dashboard Admin
    $("#navBtn").click(function() {
        $(".main").toggleClass('animate');
    });
    $("a[data-panel='panel']").click(function() {
        let panelId = $(this).attr("id");      
        $(".link").removeClass("link-active");
        $("#" + panelId).addClass("link-active");
        $(".panel-tab").removeClass("active");
        $("#" + panelId + "-panel").addClass("active");
    });  
    $('.deleteUser').click(function() {
        let idUtente = $(this).data("id");
        swal({
            title: "Sei sicuro?",
            text: "L'eliminazione dell'utente sarà irreversibile",
            icon: "warning",
            buttons: ["Annulla", "Prosegui"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../inc/elimina-utente.php',
                    data: { idUtente: idUtente },
                    success: function(data) {
                        window.location.href = "login?messaggio=Account+eliminato%21";
                    },
                    error: function() {
                        alert('Errore nella richiesta AJAX');
                    }
                });
            } else {
                return
            }
        }); 
    });
    $('.deletePage').click(function() {
        let idPage = $(this).data("id");
        swal({
            title: "Sei sicuro?",
            text: "L'eliminazione della pagina sarà irreversibile",
            icon: "warning",
            buttons: ["Annulla", "Prosegui"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../inc/elimina-pagina.php',
                    data: { idPage: idPage },
                    success: function(data) {
                        swal("Ottimo!", "Pagina eliminata con successo", "success")
                        .then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        alert('Errore nella richiesta AJAX');
                    }
                });
            } else {
                return
            }
        });
    });
});
