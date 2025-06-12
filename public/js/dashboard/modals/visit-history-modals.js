// Gestione modali per la cronologia visite
$(document).ready(function() {
    
    // Edit VisitHistory - Load Data usando data attributes
    $(document).on("click", ".edit-visit-history", function () {
        const $this = $(this);
        const visitHistoryId = $this.attr("data-id");

        $("#edit_visit_history_id").val(visitHistoryId);
        $("#edit_user_id").val($this.attr("data-user-id") || "");
        $("#edit_visit_date").val($this.attr("data-visit-date") || "");
        $("#edit_duration").val($this.attr("data-duration") || "");
        $("#edit_rating").val($this.attr("data-rating") || "");
        $("#edit_notes").val($this.attr("data-notes") || "");

        // Gestione attrazioni JSON
        const attractions = $this.attr("data-attractions");
        if (attractions) {
            try {
                const attractionsArray = JSON.parse(attractions);
                $("#edit_attractions").val(
                    JSON.stringify(attractionsArray, null, 2)
                );
            } catch (e) {
                $("#edit_attractions").val(attractions);
            }
        }

        $("#editVisitHistoryModal").modal("show");
    });
});