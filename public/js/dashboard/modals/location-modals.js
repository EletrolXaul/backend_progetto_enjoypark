// Gestione modali per le location
$(document).ready(function() {
    
    // Edit Location - Load Data (CORRETTA)
    $(".edit-location").click(function () {
        const locationId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_location_id").val(locationId);
        // PROBLEMA: Legge dalle celle invece dei data attributes
        $("#edit_name").val($(this).data("name"));
        $("#edit_description").val($(this).data("description"));
        $("#edit_type").val($(this).data("type"));
        $("#edit_latitude").val($(this).data("latitude"));
        $("#edit_longitude").val($(this).data("longitude"));
        $("#edit_icon").val($(this).data("icon"));
        $("#edit_color").val($(this).data("color"));
        $("#edit_metadata").val($(this).data("metadata"));
        $("#edit_is_visible").prop("checked", $(this).data("is-visible"));
        $("#editLocationModal").modal("show");
    });
});