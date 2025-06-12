// Gestione modali per le carte di credito mock
$(document).ready(function() {
    
    // Edit MockCreditCard - Load Data usando data attributes
    $(document).on("click", ".edit-mock-credit-card", function () {
        const $this = $(this);
        const mockCreditCardId = $this.attr("data-id");

        $("#edit_mock_credit_card_id").val(mockCreditCardId);
        $("#edit_card_number").val($this.attr("data-card-number") || "");
        $("#edit_cardholder_name").val($this.attr("data-cardholder-name") || "");
        $("#edit_expiry_date").val($this.attr("data-expiry-date") || "");
        $("#edit_cvv").val($this.attr("data-cvv") || "");
        $("#edit_card_type").val($this.attr("data-card-type") || "");
        $("#edit_balance").val($this.attr("data-balance") || "");

        // Gestione corretta del checkbox
        const isActive = $this.attr("data-is-active");
        $("#edit_is_active").prop(
            "checked",
            isActive === "1" || isActive === "true" || isActive === true
        );

        $("#editMockCreditCardModal").modal("show");
    });
});