// codice JavaScript che utilizza la libreria jQuery per creare un'interfaccia per la gestione dei prodotti
const BASEURL = "../api_server/api/";

// cambia il titolo della pagina
function changePageTitle(page_title){
    $('#page-title').text(page_title); // titolo pagina
    document.title = page_title; // titolo window
}
 
// metodo personalizzato per jQuery che consente di convertire i valori del modulo in un oggetto JavaScript
$.fn.serializeObject = function() {
    let o = {};
    let a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
// La funzione sendRequest() viene utilizzata per inviare richieste HTTP all'API utilizzando la funzione fetch()
function sendRequest(api, callback, method="GET", body) {
    // Viene utilizzata una costante chiamata BASEURL per impostare l'URL dell'API, che verrà utilizzata per inviare richieste HTTP per recuperare, creare, aggiornare e eliminare i prodotti
    const fetchPromise = fetch(BASEURL + api, {
        method, // shorthand property name: dato che la variabile ha lo stesso nome della proprietà, equivale a "method: method"
        headers: body ? { 'Content-Type': 'application/json' } : undefined,
        body
    });
    fetchPromise
    .then( (response) => {
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
    .then ( data => callback(data) )
    .catch ((error) => {
        msg = error.message || 'Errore sconosciuto';
        console.error(`Errore: ${msg}`);
    })
}


// diverse funzioni per generare codice HTML per i pulsanti e la tabella dei prodotti
function create_tavolo_button() {
    const createButton = `
        <!-- create  button: when clicked, it will load the create tavolo form -->
			<div id='create-tavolo' class='btn btn-warning btn-md pull-right mb-3 create-tavolo-button'>
				<span class='fa fa-plus'></span> Inserisci nuovo tavolo
			</div>`;
    return createButton;
}

function back_to_tavoli_button() {
    const backButton = `
        <!-- read tavoli button: when clicked, it will show the tavolo's list -->
        <div id='read-tavoli' class='btn btn-warning btn-md pull-right mb-3 read-tavoli-button'>
            <span class='fa fa-arrow-left'></span> Torna a tutti i tavoli
        </div>`;
    return backButton;
}
// La funzione tavoli_table() accetta un elenco di prodotti e genera il codice HTML per una tabella che mostra i dettagli dei prodotti, come il numero, il numero di persone e la disponibilità.
function tavoli_table(tavoli) {
    let table = `
        <!-- start table -->
        <table class='table table-bordered table-striped'>
            <thead>
            <tr>
                <th class='text-center'>Numero</th>
                <th class="text-center">Persone</th>
                <th class='text-center'>Disponibilita</th>
                <th class='text-center'>Esterno</th>
                <th></th>
            </tr>
            </thead><tbody>`;

    // loop through list of data
    $.each(tavoli, function(key,val) {
        // creazione nuova riga per record
        table+=`<tr>
            <td class='text-center'>` + val.numero + `</td>
            <td class='text-center'>` + val.persone + `</td>
            <td class='text-center'><i class='fa fa-circle' style="color: ` + isAvailable(val.disponibilita) + `;"></i></td>
            <td class='text-center'><i class='fa fa-circle' style="color: ` + isAvailable(val.esterno) + `;"></i></td>
            <!-- 'action' buttons -->
            <td class='text-center'>
               
                <!-- edit button -->
                <button class='btn btn-warning me-2 update-tavolo-button' data-id='` + val.numero + `'>
                    <span class='fa fa-edit'></span> <small>Modifica</small>
                </button>&nbsp&nbsp&nbsp&nbsp&nbsp
                <!-- delete button -->
                <button class='btn btn-danger delete-tavolo-button' data-id='` + val.numero + `'>
                    <span class='fa fa-remove'></span> <small>Cancella</small>
                </button>
            </td>
        </tr>`;
    });
    // fine tabella
    table+=`</tbody></table>
    `;
    
    return table;

}

function isAvailable(val){
    let toret;
if(val==1){
    toret="green";
}else{
 toret="red";
}
return toret;
}
