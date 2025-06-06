<!-- Add Attraction Modal -->
<div class="modal fade" id="addAttractionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuova Attrazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAttractionForm">
                    <div class="mb-3">
                        <label for="attraction_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="attraction_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacità</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Durata (minuti)</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="min_height" class="form-label">Altezza Minima (cm)</label>
                        <input type="number" class="form-control" id="min_height" name="min_height" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveAttractionBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Attraction Modal -->
<div class="modal fade" id="editAttractionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Attrazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAttractionForm">
                    <input type="hidden" id="edit_attraction_id" name="id">
                    <div class="mb-3">
                        <label for="edit_attraction_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_attraction_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_capacity" class="form-label">Capacità</label>
                        <input type="number" class="form-control" id="edit_capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_duration" class="form-label">Durata (minuti)</label>
                        <input type="number" class="form-control" id="edit_duration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_min_height" class="form-label">Altezza Minima (cm)</label>
                        <input type="number" class="form-control" id="edit_min_height" name="min_height" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateAttractionBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>