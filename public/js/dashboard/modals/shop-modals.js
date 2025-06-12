// Gestione modali per i negozi
$(document).ready(function() {
    
    // Gestione modifica negozi
    $(document).on("click", ".edit-shop", function () {
        const $this = $(this);
        const shopId = $this.attr("data-id");
        const shopName = $this.attr("data-name");
        const shopSlug = $this.attr("data-slug");
        const shopDescription = $this.attr("data-description");
        const shopCategory = $this.attr("data-category");
        const shopLocationX = $this.attr("data-location-x");
        const shopLocationY = $this.attr("data-location-y");
        const shopImage = $this.attr("data-image");
        const shopOpeningHours = $this.attr("data-opening-hours");
        const shopSpecialties = $this.attr("data-specialties");

        // Popola i campi del form di modifica
        $("#edit_shop_id").val(shopId);
        $("#edit_shop_slug").val(shopSlug);
        $("#edit_shop_name").val(shopName);
        $("#edit_shop_category").val(shopCategory);
        $("#edit_shop_description").val(shopDescription);
        $("#edit_shop_opening_hours").val(shopOpeningHours);
        $("#edit_shop_location_x").val(shopLocationX);
        $("#edit_shop_location_y").val(shopLocationY);
        $("#edit_shop_image").val(shopImage);

        // Handle specialties
        if (shopSpecialties) {
            try {
                const specialties =
                    typeof shopSpecialties === "string"
                        ? shopSpecialties
                        : JSON.stringify(shopSpecialties);
                $("#edit_shop_specialties").val(specialties);
            } catch (e) {
                console.log("Error handling shop specialties:", e);
                $("#edit_shop_specialties").val(shopSpecialties);
            }
        }

        $("#editShopModal").modal("show");
    });
});