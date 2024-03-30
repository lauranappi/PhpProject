$(document).ready(function() {
 
    // Questo codice utilizza la libreria jQuery per gestire l'evento di clic su un pulsante "Leggi uno" e recuperare l'ID del prodotto cliccato
    $(document).on('click', '.read-one-product-button', function(e) { // first par = event; second (optional) par = selector (in this case the class); last par = event handler
		e.preventDefault();

        // get product id
		const id = $(this).attr('data-id'); // this = bottone cliccato; leggi il valore di data-id attribute

		sendRequest("read_one.php?id="+id, data => { //data = un prodotto (oggetto JSON)
			// Quando l'utente clicca sul pulsante "Leggi uno", viene chiamata una funzione che invia una richiesta GET all'URL "read_one.php?id=" + id
			let read_one_product_html=back_to_products_button();
			read_one_product_html+=`
			<!-- product data will be shown in this table -->
			<table class='table table-bordered'>
				<!-- product name -->
				<tr>
					<td class='w-25 fw-bold'>Nome</td>
					<td class='w-75'>` + data.name + `</td>
				</tr>
				<!-- product price -->
				<tr>
					<td class='fw-bold'>Prezzo</td>
					<td>` + data.price + ` euro</td>
				</tr>
				<!-- product description -->
				<tr>
					<td class='fw-bold'>Descrizione</td>
					<td>` + data.description + `</td>
				</tr>
				<!-- product category name -->
				<tr>
					<td class='fw-bold'>Categoria</td>
					<td>` + data.category_name + `</td>
				</tr>
			</table>`;
			//La funzione genera una stringa HTML che mostra i dati del prodotto in una tabella
			
			// la funzione utilizza jQuery per inserire questo codice HTML nell'elemento con l'ID "page-content" dell'app
			$("#page-content").html(read_one_product_html);
 
			// cambia il titolo della pagina
			changePageTitle("Leggi fumetto");
		});
    });
});