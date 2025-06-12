// API calls per i negozi
$(document).ready(function() {
    window.shopApi = {
        // Add Shop
        addShop: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/shops",
                "POST",
                formData,
                successCallback,
                errorCallback,
                "application/json"
            );
        },

        // Update Shop
        updateShop: function(shopId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/shops/${shopId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback,
                "application/json"
            );
        },

        // Delete Shop
        deleteShop: function(shopId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/shops/${shopId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione del negozio");
                }
            );
        }
    };
});