// API calls per gli ordini
$(document).ready(function() {
    window.orderApi = {
        // Add Order
        addOrder: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/orders",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update Order
        updateOrder: function(orderId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/orders/${orderId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback,
                null,
                {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    "Accept": "application/json"
                }
            );
        },

        // Delete Order
        deleteOrder: function(orderId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/orders/${orderId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione dell'ordine");
                }
            );
        }
    };
});