// Funzioni di utilità condivise per le API
const ApiUtils = {
    // Funzione per gestire gli errori delle chiamate API
    handleApiError: function(xhr, errorCallback) {
        if (errorCallback) {
            const errors = xhr.responseJSON?.errors;
            let errorMessage = "Si sono verificati i seguenti errori:<ul>";
            
            for (const key in errors) {
                errorMessage += `<li>${errors[key]}</li>`;
            }
            
            errorMessage += "</ul>";
            errorCallback(errorMessage);
        }
    },
    
    // Funzione generica per le chiamate AJAX
    ajaxCall: function(url, type, data, successCallback, errorCallback, contentType = null, headers = null) {
        const ajaxOptions = {
            url: url,
            type: type,
            success: function(response) {
                if (successCallback) successCallback(response);
            },
            error: function(xhr) {
                if (errorCallback) {
                    if (xhr.responseJSON?.errors) {
                        ApiUtils.handleApiError(xhr, errorCallback);
                    } else {
                        errorCallback("Si è verificato un errore durante l'operazione.");
                    }
                }
            }
        };
        
        // Gestione dei dati in base al contentType
        if (contentType) {
            ajaxOptions.contentType = contentType;
            if (contentType === "application/json") {
                ajaxOptions.data = JSON.stringify(data);
            } else {
                ajaxOptions.data = data;
            }
        } else {
            ajaxOptions.data = data;
        }
        
        // Aggiunta degli header personalizzati se presenti
        if (headers) {
            ajaxOptions.headers = headers;
        }
        
        $.ajax(ajaxOptions);
    }
};