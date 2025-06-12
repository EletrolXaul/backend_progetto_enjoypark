// Gestione modali per gli utenti
$(document).ready(function() {
    
    // Add User
    $("#saveUserBtn").click(function () {
        const formData = $("#addUserForm").serialize();

        userApi.addUser(
            formData,
            function (response) {
                $("#addUserModal").modal("hide");
                ModalUtils.showSuccessAndReload("Utente aggiunto con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Edit User - Load Data
    $(".edit-user").click(function () {
        const userId = $(this).data("id");
        const row = $(this).closest("tr");

        $("#edit_user_id").val(userId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_email").val(row.find("td:eq(2)").text());
        $("#edit_membership").val(row.find("td:eq(3)").text().toLowerCase());
        $("#edit_is_admin").prop(
            "checked",
            row.find("td:eq(4)").text() === "Sì"
        );
    });

    // Update User
    $("#updateUserBtn").click(function () {
        const userId = $("#edit_user_id").val();
        const formData = $("#editUserForm").serialize();

        userApi.updateUser(
            userId,
            formData,
            function (response) {
                $("#editUserModal").modal("hide");
                ModalUtils.showSuccessAndReload("Utente aggiornato con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Delete User
    $(".delete-user").click(function () {
        if (confirm("Sei sicuro di voler eliminare questo utente?")) {
            const userId = $(this).data("id");

            userApi.deleteUser(
                userId,
                function (response) {
                    ModalUtils.showSuccessAndReload("Utente eliminato con successo!");
                },
                function (errorMessage) {
                    ModalUtils.showError(errorMessage);
                }
            );
        }
    });
});