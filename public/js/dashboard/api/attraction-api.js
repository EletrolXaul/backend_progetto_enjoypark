// API calls per le attrazioni
$(document).ready(function() {
    window.attractionApi = {
        // Add Attraction
        addAttraction: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/attractions",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Attraction
        updateAttraction: function(attractionId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/attractions/${attractionId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete Attraction
        deleteAttraction: function(attractionId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/attractions/${attractionId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione dell'attrazione");
                }
            );
        }
    };
});