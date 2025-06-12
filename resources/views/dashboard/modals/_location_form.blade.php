<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuova Posizione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLocationForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="location_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location_category" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="location_category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitudine</label>
                        <input type="number" step="0.00000001" class="form-control" id="latitude" name="latitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitudine</label>
                        <input type="number" step="0.00000001" class="form-control" id="longitude" name="longitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icona</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Colore</label>
                        <input type="color" class="form-control" id="color" name="color">
                    </div>
                    <div class="mb-3">
                        <label for="metadata" class="form-label">Metadati (JSON)</label>
                        <textarea class="form-control" id="metadata" name="metadata" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" checked>
                        <label class="form-check-label" for="is_visible">Visibile</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveLocationBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Location Modal -->
<div class="modal fade" id="editLocationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Posizione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLocationForm">
                    <input type="hidden" id="edit_location_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="edit_category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_latitude" class="form-label">Latitudine</label>
                        <input type="number" step="0.00000001" class="form-control" id="edit_latitude" name="latitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_longitude" class="form-label">Longitudine</label>
                        <input type="number" step="0.00000001" class="form-control" id="edit_longitude" name="longitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_icon" class="form-label">Icona</label>
                        <input type="text" class="form-control" id="edit_icon" name="icon">
                    </div>
                    <div class="mb-3">
                        <label for="edit_color" class="form-label">Colore</label>
                        <input type="color" class="form-control" id="edit_color" name="color">
                    </div>
                    <div class="mb-3">
                        <label for="edit_metadata" class="form-label">Metadati (JSON)</label>
                        <textarea class="form-control" id="edit_metadata" name="metadata" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="edit_is_visible" name="is_visible">
                        <label class="form-check-label" for="edit_is_visible">Visibile</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateLocationBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>