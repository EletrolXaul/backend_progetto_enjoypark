// This file handles all modal interactions
$(document).ready(function() {
    // User Modals
    
    // Add User
    $('#saveUserBtn').click(function() {
        const formData = $('#addUserForm').serialize();
        
        userApi.addUser(formData, 
            function(response) {
                $('#addUserModal').modal('hide');
                showAlert('Utente aggiunto con successo!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            function(errorMessage) {
                showAlert(errorMessage, 'danger');
            }
        );
    });

    // Edit User - Load Data
    $('.edit-user').click(function() {
        const userId = $(this).data('id');
        const row = $(this).closest('tr');
        
        $('#edit_user_id').val(userId);
        $('#edit_name').val(row.find('td:eq(1)').text());
        $('#edit_email').val(row.find('td:eq(2)').text());
        $('#edit_membership').val(row.find('td:eq(3)').text().toLowerCase());
        $('#edit_is_admin').prop('checked', row.find('td:eq(4)').text() === 'Sì');
    });

    // Update User
    $('#updateUserBtn').click(function() {
        const userId = $('#edit_user_id').val();
        const formData = $('#editUserForm').serialize();
        
        userApi.updateUser(userId, formData,
            function(response) {
                $('#editUserModal').modal('hide');
                showAlert('Utente aggiornato con successo!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            function(errorMessage) {
                showAlert(errorMessage, 'danger');
            }
        );
    });

    // Delete User
    $('.delete-user').click(function() {
        if (confirm('Sei sicuro di voler eliminare questo utente?')) {
            const userId = $(this).data('id');
            
            userApi.deleteUser(userId,
                function(response) {
                    showAlert('Utente eliminato con successo!');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                function(errorMessage) {
                    showAlert(errorMessage, 'danger');
                }
            );
        }
    });
    
    // Order Modals
    
    // Add Order
    $('#saveOrderBtn').click(function() {
        const formData = $('#addOrderForm').serialize();
        
        orderApi.addOrder(formData, 
            function(response) {
                $('#addOrderModal').modal('hide');
                showAlert('Ordine aggiunto con successo!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            function(errorMessage) {
                showAlert(errorMessage, 'danger');
            }
        );
    });

    // Edit Order - Load Data
    $('.edit-order').click(function() {
        const orderId = $(this).data('id');
        $('#edit_order_id').val(orderId);
        
        // Qui dovresti caricare i dati dell'ordine dal server o dalla riga della tabella
        // Per semplicità, assumiamo che i dati siano disponibili nella riga della tabella
        const row = $(this).closest('tr');
        $('#edit_user_id').val(row.find('td:eq(2)').data('user-id'));
        $('#edit_total_price').val(row.find('td:eq(3)').text().replace('€', ''));
        $('#edit_status').val(row.find('td:eq(4)').text().toLowerCase());
        
        $('#editOrderModal').modal('show');
    });

    // Update Order
    $('#updateOrderBtn').click(function() {
        const orderId = $('#edit_order_id').val();
        const formData = $('#editOrderForm').serialize();
        
        orderApi.updateOrder(orderId, formData,
            function(response) {
                $('#editOrderModal').modal('hide');
                showAlert('Ordine aggiornato con successo!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            function(errorMessage) {
                showAlert(errorMessage, 'danger');
            }
        );
    });

    // Delete Order
    $('.delete-order').click(function() {
        const orderId = $(this).data('id');
        
        if (confirm('Sei sicuro di voler eliminare questo ordine?')) {
            orderApi.deleteOrder(orderId,
                function(response) {
                    showAlert('Ordine eliminato con successo!');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                function(errorMessage) {
                    showAlert(errorMessage, 'danger');
                }
            );
        }
    });
    
    // Continua con gli altri modali per le altre entità...
});