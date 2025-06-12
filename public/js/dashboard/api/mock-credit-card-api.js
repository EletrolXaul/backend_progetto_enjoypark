// API calls per le carte di credito simulate
$(document).ready(function() {
    window.mockCreditCardApi = {
        // Add MockCreditCard
        addMockCreditCard: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/mock-credit-cards",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update MockCreditCard
        updateMockCreditCard: function(mockCreditCardId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/mock-credit-cards/${mockCreditCardId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete MockCreditCard
        deleteMockCreditCard: function(mockCreditCardId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/mock-credit-cards/${mockCreditCardId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione della carta di credito");
                }
            );
        }
    };
});