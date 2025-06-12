// API calls per le posizioni
$(document).ready(function() {
    window.locationApi = {
        // Add Location
        addLocation: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/locations",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Location
        updateLocation: function(locationId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/locations/${locationId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete Location
        deleteLocation: function(locationId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/locations/${locationId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione della posizione");
                }
            );
        }
    };
});