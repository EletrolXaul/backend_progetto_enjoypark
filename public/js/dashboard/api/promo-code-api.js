// API calls per i codici promozionali
$(document).ready(function() {
    window.promoCodeApi = {
        // Add PromoCode
        addPromoCode: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/promo-codes",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update PromoCode
        updatePromoCode: function(promoCodeId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/promo-codes/${promoCodeId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete PromoCode
        deletePromoCode: function(promoCodeId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/promo-codes/${promoCodeId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione del codice promozionale");
                }
            );
        }
    };
});