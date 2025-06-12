// API calls per i servizi
$(document).ready(function() {
    window.serviceApi = {
        // Add Service
        addService: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/services",
                "POST",
                formData,
                successCallback,
                errorCallback,
                "application/json"
            );
        },

        // Update Service
        updateService: function(serviceId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/services/${serviceId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback,
                "application/json"
            );
        },

        // Delete Service
        deleteService: function(serviceId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/services/${serviceId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione del servizio");
                }
            );
        }
    };
});