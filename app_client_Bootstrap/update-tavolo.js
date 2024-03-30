//Questo codice utilizza la libreria jQuery per gestire l'evento di clic su un pulsante "Aggiorna prodotto" e recuperare l'ID del prodotto cliccato
$(document).ready(function() {

    // Quando l'utente clicca sul pulsante "Aggiorna prodotto", viene chiamata una funzione che invia una richiesta GET all'URL "read_one.php?numero=" + numero
    $(document).on('click', '.update-tavolo-button', function(e) { // first par = event; second (optional) par = selector (in this case the class); last par = event handler
		e.preventDefault();

        // recupera l'id del prodotto
		const numero = $(this).attr('data-id'); // this = clicked button; read the value of data-id attribute
		
		// la richiesta restituisce i dati del prodotto selezionato in formato JSON
		sendRequest("read_one.php?numero="+numero, data => {
			let update_tavolo_html=back_to_tavoli_button();
			// La funzione quindi genera una stringa HTML che mostra un form per aggiornare i dati del prodotto, come il prezzo, se è esterno o meno e se è disponibile o meno
			update_tavolo_html+=`
				<!-- build 'update tavolo' html form -->
				<form id='update-tavolo-form' action='#' method='post' border='0'>
					<table class='table table-responsive table-bordered'>
					
						<!-- price field -->
						<tr>
							<td>Persone</td>
							<td><input value=\"` + data.persone + `\" type='number' min='1' name='persone' class='form-control' required /></td>
						</tr>
						<tr>
						<td>Esterno</td>
						<td>No<input type="radio" name='esterno' class='form-control form-check-input' value='0' ` + isSelected(data.esterno, 0) + `>
						Si<input type="radio" name='esterno' class='form-control form-check-input' value='1' ` + isSelected(data.esterno, 1) + `></td>
					</tr>
					<tr>
						<td>Disponibilita</td>
						<td>No<input type="radio" name='disponibilita' class='form-control form-check-input' value='0'  ` + isSelected(data.disponibilita, 0) + `>
						Si<input type="radio" name='disponibilita' class='form-control form-check-input' value='1'  ` + isSelected(data.disponibilita, 1) + `></td>
					</tr>
						<tr>
							<!-- hidden 'tavolo id' to identify which record to update -->
							<td><input value=\"` + numero + `\" name='numero' type='hidden' /></td>
							<!-- button to submit form -->
							<td>
								<button type='submit' class='btn btn-warning'>
									<span class='fa fa-edit'></span> Aggiorna tavolo
								</button>
							</td>
						</tr>
					</table>
				</form>`;				

			// a funzione utilizza jQuery per inserire questo codice HTML nell'elemento con l'ID "page-content" dell'app
			$("#page-content").html(update_tavolo_html);
 
			// modifica il titolo della pagina con la funzione changePageTitle
			changePageTitle("Aggiorna tavolo");
		});
    });
	
    // Quando l'utente invia il form di aggiornamento, viene chiamata un'altra funzione che utilizza la libreria jQuery per recuperare i dati del form e inviare una richiesta PUT all'URL "update.php" con i dati del form
	$(document).on('submit', '#update-tavolo-form', function(e) {
		e.preventDefault();

		// get form data
		const form_data=JSON.stringify($(this).serializeObject());
		//console.log(form_data);

		//La funzione showtavoli() viene chiamata per aggiornare la pagina
		sendRequest("update.php", showTavoli, "PUT", form_data);
		});

		function isSelected(data, value){
			if(data==value){
				return "checked";
			}
		}
});