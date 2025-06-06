// This file handles all API calls for CRUD operations
$(document).ready(function() {
    // User API calls
    window.userApi = {
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
    
    // Order API calls
    window.orderApi = {
        // Add Order
        addOrder: function(formData, successCallback, errorCallback) {
            $.ajax({
                url: '/orders',
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
        
        // Update Order
        updateOrder: function(orderId, formData, successCallback, errorCallback) {
            $.ajax({
                url: `/orders/${orderId}`,
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
        
        // Delete Order
        deleteOrder: function(orderId, successCallback, errorCallback) {
            $.ajax({
                url: `/orders/${orderId}`,
                type: 'DELETE',
                success: function(response) {
                    if (successCallback) successCallback(response);
                },
                error: function(xhr) {
                    if (errorCallback) errorCallback('Errore durante l\'eliminazione dell\'ordine');
                }
            });
        }
    };
    
    // Continua con le altre API per le altre entità...
});