// Gestione modali per gli spettacoli
$(document).ready(function() {
    
    // Edit Show - Load Data (CORRETTA)
    $(".edit-show").click(function () {
        const $this = $(this);
        const showId = $this.data("id");
        const showName = $this.data("name");
        const showSlug = $this.data("slug");
        const showDescription = $this.data("description");
        const showVenue = $this.data("venue");
        const showDuration = $this.data("duration");
        const showCategory = $this.data("category");
        const showTimes = $this.data("times");
        const showCapacity = $this.data("capacity");
        const showAvailableSeats = $this.data("available-seats");
        const showRating = $this.data("rating");
        const showPrice = $this.data("price");
        const showAgeRestriction = $this.data("age-restriction");
        const showLocationX = $this.data("location-x");
        const showLocationY = $this.data("location-y");
        const showImage = $this.data("image");

        // Popola i campi del form di modifica
        $("#edit_show_id").val(showId);
        $("#edit_show_name").val(showName);
        $("#edit_show_slug").val(showSlug);
        $("#edit_show_description").val(showDescription);
        $("#edit_show_venue").val(showVenue);
        $("#edit_show_duration").val(showDuration);
        $("#edit_show_category").val(showCategory);
        $("#edit_show_capacity").val(showCapacity);
        $("#edit_show_available_seats").val(showAvailableSeats);
        $("#edit_show_rating").val(showRating);
        $("#edit_show_price").val(showPrice);
        $("#edit_show_age_restriction").val(showAgeRestriction);
        $("#edit_show_location_x").val(showLocationX);
        $("#edit_show_location_y").val(showLocationY);
        $("#edit_show_image").val(showImage);

        // Gestisci gli orari (times) - VERSIONE SEMPLIFICATA
        if (showTimes) {
            $("#edit_show_times").val(showTimes);
        }

        $("#editShowModal").modal("show");
    });

    // Update Show
    $("#updateShowBtn").click(function () {
        const showId = $("#edit_show_id").val();

        // Serializza i dati del form
        let formData = $("#editShowForm").serializeArray();

        // Converti la stringa times in array
        const timesIndex = formData.findIndex((item) => item.name === "times");
        if (timesIndex !== -1) {
            const timesString = formData[timesIndex].value;
            // Rimuovi il campo times dalla serializzazione
            formData.splice(timesIndex, 1);

            // Aggiungi ogni orario come elemento separato dell'array
            if (timesString) {
                const timesArray = timesString
                    .split(",")
                    .map((time) => time.trim());
                timesArray.forEach((time, index) => {
                    formData.push({
                        name: `times[${index}]`,
                        value: time,
                    });
                });
            }
        }

        // Converti l'array in formato per jQuery
        const serializedData = $.param(formData);

        showApi.updateShow(
            showId,
            serializedData,
            function (response) {
                $("#editShowModal").modal("hide");
                ModalUtils.showSuccessAndReload("Spettacolo aggiornato con successo!");
            },
            function (errorMessage) {
                ModalUtils.showError(errorMessage);
            }
        );
    });

    // Delete Show
    $(".delete-show").click(function () {
        const showId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo spettacolo?")) {
            showApi.deleteShow(
                showId,
                function (response) {
                    ModalUtils.showSuccessAndReload("Spettacolo eliminato con successo!");
                },
                function (errorMessage) {
                    ModalUtils.showError(errorMessage);
                }
            );
        }
    });
});