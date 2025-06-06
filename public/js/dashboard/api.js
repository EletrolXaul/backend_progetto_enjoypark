// This file handles all API calls for CRUD operations
$(document).ready(function() {
    // User API calls
    const userApi = {
        // Add User
        addUser: function(formData, successCallback, errorCallback) {
            $.ajax({
                url: '/users',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (successCallback) successCallback(response);
                },
                error: function(xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Si sono verificati i seguenti errori:<ul>';
                        
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        
                        errorMessage += '</ul>';
                        errorCallback(errorMessage);
                    }
                }
            });
        },
        
        // Update User
        updateUser: function(userId, formData, successCallback, errorCallback) {
            $.ajax({
                url: `/users/${userId}`,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (successCallback) successCallback(response);
                },
                error: function(xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Si sono verificati i seguenti errori:<ul>';
                        
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        
                        errorMessage += '</ul>';
                        errorCallback(errorMessage);
                    }
                }
            });
        },
        
        // Delete User
        deleteUser: function(userId, successCallback, errorCallback) {
            $.ajax({
                url: `/users/${userId}`,
                type: 'DELETE',
                success: function(response) {
                    if (successCallback) successCallback(response);
                },
                error: function(xhr) {
                    if (errorCallback) errorCallback('Errore durante l\'eliminazione dell\'utente.');
                }
            });
        }
    };
    
    // Make API available globally
    window.userApi = userApi;
    
    // Similar APIs can be created for other models (attractions, orders, etc.)
});