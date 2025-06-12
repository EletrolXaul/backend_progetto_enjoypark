// API calls per gli spettacoli
$(document).ready(function() {
    window.showApi = {
        // Add Show
        addShow: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/shows",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Show
        updateShow: function(showId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/shows/${showId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete Show
        deleteShow: function(showId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/shows/${showId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione dello spettacolo");
                }
            );
        }
    };
});