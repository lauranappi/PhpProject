//Questo codice utilizza la libreria jQuery e il framework Bootbox.js per creare una finestra di conferma quando un utente clicca sul pulsante "Elimina prodotto"
$(document).ready(function() {
 
   $(document).on('click', '.delete-tavolo-button',  function (e) { // first par = event; second (optional) par = selector (in this case the class); last par = event handler
		e.preventDefault();

        // get the tavolo id
		const tavolo_numero = $(this).attr('data-id'); // this = clicked button; read the value of data-id attribute

		// Quando l'utente clicca sul pulsante, viene chiamata una funzione che utilizza la libreria Bootbox.js per mostrare una finestra di conferma con il messaggio "Sei sicuro di voler eliminare questo tavolo?" e i pulsanti "Conferma" e "Annulla"
		bootbox.confirm({
			title: "Attenzione!",
			message: "Sei sicuro di volere eliminare questo tavolo?",
			swapButtonOrder: true,
			buttons: {
				//Se l'utente clicca su "Conferma", viene inviata una richiesta DELETE all'URL "delete.php?numero=" + tavolo_numero e la funzione showTavoli viene chiamata per aggiornare la pagina
				confirm: {
					label: '<span class="fa fa-check"></span> Conferma',
					className: 'btn-danger'
				},
				//Se l'utente clicca su "Annulla", la finestra di conferma viene chiusa e non viene inviata alcuna richiesta
				cancel: {
					label: '<span class="fa fa-times"></span> Annulla',
					className: 'btn-secondary'
				}
			},
			callback: function (result) {
				if (result) {
					//  manda la richiesta di delete per eliminare il servizio se l'user conferma
					sendRequest("delete.php?numero="+tavolo_numero, showTavoli, "DELETE");
				}
			}
		});
    });
});