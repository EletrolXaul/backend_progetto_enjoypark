// Gestione modali per i servizi
$(document).ready(function() {
    
    // Gestione modifica servizi
    $(document).on("click", ".edit-service", function () {
        const $button = $(this);

        // IMPORTANTE: Reset del form PRIMA di popolare i dati
        $("#editServiceForm")[0].reset();

        const serviceData = {
            id: $button.data("id"),
            slug: $button.data("slug"),
            name: $button.data("name"),
            category: $button.data("category"),
            description: $button.data("description"),
            icon: $button.data("icon"),
            available_24h: $button.data("available-24h"),
            location_x: $button.data("location-x"),
            location_y: $button.data("location-y"),
            features: $button.data("features"),
        };

        console.log("Dati servizio da modificare:", serviceData);

        // Popola i campi del form di modifica
        $("#edit_service_id").val(serviceData.id);
        $("#edit_slug").val(serviceData.slug);
        $("#edit_name").val(serviceData.name);

        // Assicuriamoci che la categoria venga impostata correttamente
        console.log("Categoria da impostare:", serviceData.category);
        const categoryField = document.getElementById("edit_category");
        if (categoryField) {
            categoryField.value = serviceData.category;
            console.log("Categoria impostata direttamente:", categoryField.value);
        } else {
            console.error("Campo categoria non trovato!");
        }

        $("#edit_description").val(serviceData.description);
        $("#edit_icon").val(serviceData.icon);
        $("#edit_location_x").val(serviceData.location_x);
        $("#edit_location_y").val(serviceData.location_y);

        // Handle checkbox
        const isAvailable24h =
            serviceData.available_24h == 1 ||
            serviceData.available_24h === true ||
            serviceData.available_24h === "true" ||
            serviceData.available_24h === "1";
        $("#edit_available_24h").prop("checked", isAvailable24h);

        // Handle features
        let featuresValue = "";
        if (serviceData.features) {
            try {
                if (typeof serviceData.features === "string") {
                    featuresValue = serviceData.features;
                } else {
                    featuresValue = JSON.stringify(serviceData.features);
                }
            } catch (e) {
                console.error("Errore features:", e);
                featuresValue = serviceData.features.toString();
            }
        }
        $("#edit_features").val(featuresValue);

        // Debug finale
        setTimeout(function () {
            console.log("Verifica finale campi:");
            console.log("Nome:", $("#edit_name").val());
            console.log("Categoria:", $("#edit_category").val());
            console.log("Checkbox:", $("#edit_available_24h").is(":checked"));
        }, 200);

        $("#editServiceModal").modal("show");
    });
});