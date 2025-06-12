// Gestione modali per le attrazioni
$(document).ready(function() {
    
    // Add Attraction
    $("#saveAttractionBtn").click(function () {
        // Imposta valori casuali per location_x e location_y se vuoti
        if ($("#attraction_location_x").val() === "") {
            $("#attraction_location_x").val(Math.floor(Math.random() * 800) + 100);
        }
        if ($("#attraction_location_y").val() === "") {
            $("#attraction_location_y").val(Math.floor(Math.random() * 600) + 100);
        }

        // Imposta un'immagine placeholder se il campo è vuoto
        if ($("#attraction_image").val() === "") {
            $("#attraction_image").val("placeholder.jpg");
        }

        // Gestisci il campo features come array JSON
        const features = [];
        $("#addAttractionForm .feature-checkbox:checked").each(function () {
            features.push($(this).val());
        });
        $("#attraction_features").val(JSON.stringify(features));

        const formData = $("#addAttractionForm").serialize();

        attractionApi.addAttraction(
            formData,
            function (response) {
                $("#addAttractionModal").modal("hide");
                ModalUtils.showSuccessAndReload("Attrazione aggiunta con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Update Attraction
    $("#updateAttractionBtn").click(function () {
        // Imposta valori casuali per location_x e location_y se vuoti
        if ($("#edit_attraction_location_x").val() === "") {
            $("#edit_attraction_location_x").val(Math.floor(Math.random() * 800) + 100);
        }
        if ($("#edit_attraction_location_y").val() === "") {
            $("#edit_attraction_location_y").val(Math.floor(Math.random() * 600) + 100);
        }

        // Gestisci il campo features come array JSON
        const features = [];
        $("#editAttractionForm .edit-feature-checkbox:checked").each(function () {
            features.push($(this).val());
        });
        $("#edit_attraction_features").val(JSON.stringify(features));

        const attractionId = $("#edit_attraction_id").val();
        const formData = $("#editAttractionForm").serialize();

        attractionApi.updateAttraction(
            attractionId,
            formData,
            function (response) {
                $("#editAttractionModal").modal("hide");
                ModalUtils.showSuccessAndReload("Attrazione aggiornata con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });
});