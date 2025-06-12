// API calls per le cronologie visite
$(document).ready(function() {
    window.visitHistoryApi = {
        // Add VisitHistory
        addVisitHistory: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/visit-histories",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update VisitHistory
        updateVisitHistory: function(visitHistoryId, formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/visit-histories/${visitHistoryId}`,
                "PUT",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Delete VisitHistory
        deleteVisitHistory: function(visitHistoryId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/visit-histories/${visitHistoryId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione della cronologia visite");
                }
            );
        }
    };
});