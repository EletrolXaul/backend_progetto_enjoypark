// Gestione modali per gli ordini
$(document).ready(function() {
    
    // Add Order
    $("#saveOrderBtn").click(function () {
        const formData = $("#addOrderForm").serialize();

        orderApi.addOrder(
            formData,
            function (response) {
                $("#addOrderModal").modal("hide");
                ModalUtils.showSuccessAndReload("Ordine aggiunto con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Edit Order - Load Data
    $(".edit-order").click(function () {
        const orderId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_order_id").val(orderId);

        // Correzione: Utente è nella colonna 2, non 1
        const userCell = row.find("td:eq(2)");
        const userId = userCell.data("user-id"); // Usa il data-user-id invece del testo
        $("#edit_user_id").val(userId);

        // Correzione: Prezzo totale è nella colonna 3, rimuovi il simbolo €
        const priceText = row.find("td:eq(3)").text().replace("€", "").trim();
        $("#edit_total_price").val(priceText);

        // Correzione: Stato è nella colonna 4, usa il data-status attribute della cella
        const statusCell = row.find("td:eq(4)");
        const statusValue = statusCell.data("status");
        console.log("Status value from cell:", statusValue);
        $("#edit_status").val(statusValue);

        // Verifica che il valore sia stato impostato correttamente
        setTimeout(() => {
            console.log("Selected status:", $("#edit_status").val());
        }, 100);

        $("#editOrderModal").modal("show");
    });

    // Update Order
    $("#updateOrderBtn").click(function () {
        const orderId = $("#edit_order_id").val();
        const formData = $("#editOrderForm").serialize();

        orderApi.updateOrder(
            orderId,
            formData,
            function (response) {
                $("#editOrderModal").modal("hide");
                ModalUtils.showSuccessAndReload("Ordine aggiornato con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Delete Order
    $(".delete-order").click(function () {
        const orderId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo ordine?")) {
            orderApi.deleteOrder(
                orderId,
                function (response) {
                    ModalUtils.showSuccessAndReload("Ordine eliminato con successo!");
                },
                function (errorMessage) {
                    ModalUtils.showError(errorMessage);
                }
            );
        }
    });
});