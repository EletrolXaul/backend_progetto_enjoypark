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
        const ticketId = $(this).data("id");
        const row = $(this).closest("tr");

        $("#edit_ticket_id").val(ticketId);
        $("#edit_code").val(row.find("td:eq(1)").text());
        $("#edit_type").val(row.find("td:eq(2)").text());
        $("#edit_price").val(row.find("td:eq(3)").text().replace("€", ""));
        $("#edit_validity").val(row.find("td:eq(4)").text());

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