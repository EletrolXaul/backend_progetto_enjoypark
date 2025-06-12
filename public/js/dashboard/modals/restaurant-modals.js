// Gestione modali per i ristoranti
$(document).ready(function() {
    
    // Edit Restaurant - Load Data usando attributi data-*
    $(document).on("click", ".edit-restaurant", function () {
        const restaurantId = $(this).data("id");
        const restaurantName = $(this).data("name");
        const restaurantSlug = $(this).data("slug");
        const restaurantCategory = $(this).data("category");
        const restaurantCuisine = $(this).data("cuisine");
        const restaurantPriceRange = $(this).data("price-range");
        const restaurantRating = $(this).data("rating");
        const restaurantDescription = $(this).data("description");
        const restaurantOpeningHours = $(this).data("opening-hours");
        const restaurantLocationX = $(this).data("location-x");
        const restaurantLocationY = $(this).data("location-y");
        const restaurantImage = $(this).data("image");
        const restaurantFeatures = $(this).data("features");

        // Popola i campi del form di modifica
        $("#edit_restaurant_id").val(restaurantId);
        $("#edit_restaurant_slug").val(restaurantSlug);
        $("#edit_restaurant_name").val(restaurantName);
        $("#edit_restaurant_category").val(restaurantCategory);
        $("#edit_restaurant_cuisine").val(restaurantCuisine);
        $("#edit_restaurant_price_range").val(restaurantPriceRange);
        $("#edit_restaurant_rating").val(restaurantRating);
        $("#edit_restaurant_description").val(restaurantDescription);
        $("#edit_restaurant_opening_hours").val(restaurantOpeningHours);
        $("#edit_restaurant_location_x").val(restaurantLocationX);
        $("#edit_restaurant_location_y").val(restaurantLocationY);
        $("#edit_restaurant_image").val(restaurantImage);

        // Reset checkboxes
        $("#editRestaurantForm input[type='checkbox']").prop("checked", false);

        // Parse and set features
        if (restaurantFeatures) {
            try {
                const features =
                    typeof restaurantFeatures === "string"
                        ? JSON.parse(restaurantFeatures)
                        : restaurantFeatures;
                if (Array.isArray(features)) {
                    features.forEach((feature) => {
                        $(
                            "#editRestaurantForm input[value='" + feature + "']"
                        ).prop("checked", true);
                    });
                }
            } catch (e) {
                console.log("Error parsing restaurant features:", e);
            }
        }

        $("#editRestaurantModal").modal("show");
    });

    // Funzioni per gestire orari di apertura e caratteristiche
    function updateOpeningHours(prefix = "") {
        const days = ["lun", "mar", "mer", "gio", "ven", "sab", "dom"];
        const openingTime = $(`#${prefix}opening_time`).val();
        const closingTime = $(`#${prefix}closing_time`).val();
        
        let selectedDays = [];
        days.forEach(day => {
            if ($(`#${prefix}day-${day}`).is(":checked")) {
                selectedDays.push(day.charAt(0).toUpperCase() + day.slice(1));
            }
        });
        
        if (selectedDays.length > 0 && openingTime && closingTime) {
            const openingHours = `${selectedDays.join("-")}: ${openingTime} - ${closingTime}`;
            $(`#${prefix}opening_hours`).val(openingHours);
        }
    }

    function updateFeatures(prefix = "") {
        const features = [];
        $(`.${prefix}feature-checkbox:checked`).each(function() {
            features.push($(this).val());
        });
        $(`#${prefix}features`).val(JSON.stringify(features));
    }

    function addCustomFeature(prefix = "") {
        const newFeature = $(`#${prefix}new-feature`).val().trim();
        if (newFeature) {
            const featureId = "feature-" + newFeature.toLowerCase().replace(/\s+/g, "-");
            const fullId = prefix + featureId;

            if ($(`#${fullId}`).length === 0) {
                const newCheckbox = `
                    <input type="checkbox" class="btn-check ${prefix}feature-checkbox" id="${fullId}" value="${newFeature}" autocomplete="off" checked>
                    <label class="btn btn-outline-secondary btn-sm m-1" for="${fullId}">${newFeature}</label>
                `;
                $(`.${prefix}feature-tags .btn-group`).append(newCheckbox);

                $(`#${fullId}`).on("change", function () {
                    updateFeatures(prefix);
                });

                updateFeatures(prefix);
                $(`#${prefix}new-feature`).val("");
            }
        }
    }

    // Event listeners per il form di aggiunta
    $("#day-lun, #day-mar, #day-mer, #day-gio, #day-ven, #day-sab, #day-dom, #opening_time, #closing_time").on("change", function () {
        updateOpeningHours();
    });

    $(".feature-checkbox").on("change", function () {
        updateFeatures();
    });

    $("#add-feature-btn").on("click", function () {
        addCustomFeature();
    });

    $("#new-feature").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            addCustomFeature();
        }
    });

    // Event listeners per il form di modifica
    $("#edit-day-lun, #edit-day-mar, #edit-day-mer, #edit-day-gio, #edit-day-ven, #edit-day-sab, #edit-day-dom, #edit_opening_time, #edit_closing_time").on("change", function () {
        updateOpeningHours("edit-");
    });

    $(".edit-feature-checkbox").on("change", function () {
        updateFeatures("edit-");
    });

    $("#edit-add-feature-btn").on("click", function () {
        addCustomFeature("edit-");
    });

    $("#edit-new-feature").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            addCustomFeature("edit-");
        }
    });

    // Inizializza i campi quando si apre il modale di aggiunta
    $("#addRestaurantModal").on("show.bs.modal", function () {
        $("#day-lun, #day-mar, #day-mer, #day-gio, #day-ven, #day-sab, #day-dom").prop("checked", true);
        $("#opening_time").val("09:00");
        $("#closing_time").val("22:00");
        updateOpeningHours();

        $(".feature-checkbox").prop("checked", false);
        updateFeatures();
    });
});