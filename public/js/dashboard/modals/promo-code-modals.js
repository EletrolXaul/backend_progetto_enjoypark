// Gestione modali per i codici promozionali
$(document).ready(function() {
    
    // Edit PromoCode - Load Data usando data attributes
    $(document).on("click", ".edit-promo-code", function () {
        const $this = $(this);
        const promoCodeId = $this.attr("data-id");

        // Popola i campi usando i data attributes dalla tabella migliorata
        $("#edit_promo_code_id").val(promoCodeId);
        $("#edit_code").val($this.attr("data-code") || "");
        $("#edit_description").val($this.attr("data-description") || "");
        $("#edit_discount").val($this.attr("data-discount") || "");
        $("#edit_type").val($this.attr("data-type") || "percentage");

        // Formatta la data nel formato YYYY-MM-DD per il campo date
        const validUntil = $this.attr("data-valid-until") || "";
        if (validUntil) {
            try {
                // Converti la data nel formato corretto per l'input date (YYYY-MM-DD)
                const date = new Date(validUntil.replace(/ /g, 'T'));
                const formattedDate = date.toISOString().split("T")[0];
                $("#edit_valid_until").val(formattedDate);
            } catch (e) {
                console.error("Errore nella formattazione della data:", e);
                $("#edit_valid_until").val("");
            }
        } else {
            $("#edit_valid_until").val("");
        }

        $("#edit_min_amount").val($this.attr("data-min-amount") || "");
        $("#edit_max_discount").val($this.attr("data-max-discount") || "");
        $("#edit_usage_limit").val($this.attr("data-usage-limit") || "0");
        $("#edit_used_count").val($this.attr("data-used-count") || "0");

        // Gestione corretta del checkbox
        const isActive = $this.attr("data-is-active");
        $("#edit_is_active").prop(
            "checked",
            isActive === "1" || isActive === "true" || isActive === true
        );

        // Debug per verificare i valori
        console.log("Data validità originale:", validUntil);
        console.log("Data validità formattata:", $("#edit_valid_until").val());
        console.log("Checkbox attivo:", $("#edit_is_active").prop("checked"));

        $("#editPromoCodeModal").modal("show");
    });
});