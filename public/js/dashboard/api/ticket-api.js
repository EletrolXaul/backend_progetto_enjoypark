// API calls per i biglietti
$(document).ready(function() {
    window.ticketApi = {
        // Add Ticket
        addTicket: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/tickets",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Ticket
        updateTicket: function(ticketId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/tickets/${ticketId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete Ticket
        deleteTicket: function(ticketId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/tickets/${ticketId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione del biglietto");
                }
            );
        }
    };
});