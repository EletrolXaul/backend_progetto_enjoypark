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
    
    // Similar handlers can be created for other models (attractions, orders, etc.)
});