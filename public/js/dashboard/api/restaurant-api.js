// API calls per i ristoranti
$(document).ready(function() {
    window.restaurantApi = {
        // Add Restaurant
        addRestaurant: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/restaurants",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Restaurant
        updateRestaurant: function(restaurantId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/restaurants/${restaurantId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete Restaurant
        deleteRestaurant: function(restaurantId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/restaurants/${restaurantId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione del ristorante");
                }
            );
        }
    };
});