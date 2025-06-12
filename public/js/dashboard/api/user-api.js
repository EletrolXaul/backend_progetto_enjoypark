// API calls per gli utenti
$(document).ready(function() {
    window.userApi = {
        // Add User
        addUser: function(formData, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                "/users",
                "POST",
                formData,
                successCallback,
                errorCallback
            );
        },

        // Update User
        updateUser: function(userId, formData, successCallback, errorCallback) {
            // Convert formData string to object to handle checkbox properly
            const data = {};
            const pairs = formData.split("&");

            pairs.forEach((pair) => {
                const [key, value] = pair.split("=");
                if (key && value !== undefined) {
                    data[decodeURIComponent(key)] = decodeURIComponent(
                        value.replace(/\+/g, " ")
                    );
                }
            });

            // Ensure is_admin is always present as boolean
            data.is_admin = $("#edit_is_admin").is(":checked") ? 1 : 0;

            ApiUtils.ajaxCall(
                `/users/${userId}`,
                "PUT",
                data,
                successCallback,
                errorCallback
            );
        },

        // Delete User
        deleteUser: function(userId, successCallback, errorCallback) {
            ApiUtils.ajaxCall(
                `/users/${userId}`,
                "DELETE",
                null,
                successCallback,
                function() {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione dell'utente.");
                }
            );
        }
    };
});