// utilizza la libreria jQuery per gestire l'evento di clic su un pulsante "Leggi prodotti" e chiamare la funzione showTavoli
$(document).ready(function() {

	// mostra una lista di prodotti quando l'utente clicca sul bottone 'read tavoli' 
		$(document).on('click', '.read-tavoli-button', function(e) { // first par = event; second (optional) par = selector (in this case the class); last par = event handler
		e.preventDefault();
		showTavoli();
	}); 

});
 
// nvia una richiesta GET all'URL "read.php" per recuperare i dati dei prodotti in formato JSON
function showTavoli() {
	// get data from the read service
	sendRequest("read.php", data => { // data = coppia tavoli: lista-prodotti (array di oggetti JSON)
		// html per elencare i prodotti
		let read_tavoli_html=create_tavolo_button();
		read_tavoli_html+=tavoli_table(data.tavoli);
		
		// la funzione utilizza jQuery per inserire questo codice HTML nell'elemento con l'ID "page-content" dell'app
		$("#page-content").html(read_tavoli_html);

		// cambia il titolo della pagina
		changePageTitle("Tavoli");
	});
} // showTavoli