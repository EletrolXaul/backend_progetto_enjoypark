// Gestione modali per i biglietti
$(document).ready(function() {
    
    // Add Ticket
    $("#saveTicketBtn").click(function () {
        const formData = $("#addTicketForm").serialize();

        ticketApi.addTicket(
            formData,
            function (response) {
                $("#addTicketModal").modal("hide");
                ModalUtils.showSuccessAndReload("Biglietto aggiunto con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Edit Ticket - Load Data
    $(".edit-ticket").click(function () {
        const $this = $(this);
        $("#edit_ticket_id").val($this.data("id"));
        $("#edit_code").val($this.data("code"));
        $("#edit_type").val($this.data("type"));
        $("#edit_price").val($this.data("price"));
        $("#edit_validity_date").val($this.data("validity-date"));
        $("#editTicketModal").modal("show");
    });

    // Update Ticket
    $("#updateTicketBtn").click(function () {
        const ticketId = $("#edit_ticket_id").val();
        const formData = $("#editTicketForm").serialize();

        ticketApi.updateTicket(
            ticketId,
            formData,
            function (response) {
                $("#editTicketModal").modal("hide");
                ModalUtils.showSuccessAndReload("Biglietto aggiornato con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Delete Ticket
    $(".delete-ticket").click(function () {
        const ticketId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo biglietto?")) {
            ticketApi.deleteTicket(
                ticketId,
                function (response) {
                    ModalUtils.showSuccessAndReload("Biglietto eliminato con successo!");
                },
                function (errorMessage) {
                    ModalUtils.showError(errorMessage);
                }
            );
        }
    });
});