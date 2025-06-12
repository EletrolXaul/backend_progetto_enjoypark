// Gestione modali per le location
$(document).ready(function() {
    
    // Edit Location - Load Data (CORRETTA)
    $(".edit-location").click(function () {
        const locationId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_location_id").val(locationId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_type").val(row.find("td:eq(3)").text());
        $("#edit_latitude").val(row.find("td:eq(4)").text());
        $("#edit_longitude").val(row.find("td:eq(5)").text());
        $("#edit_metadata").val(row.find("td:eq(6)").text());
        $("#edit_is_visible").prop(
            "checked",
            row.find("td:eq(7)").text() === "Sì"
        );
        $("#editLocationModal").modal("show");
    });
});