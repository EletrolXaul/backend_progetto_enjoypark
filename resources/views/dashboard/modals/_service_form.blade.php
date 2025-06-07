<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Servizio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addServiceForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_x" class="form-label">Posizione X</label>
                        <input type="number" step="0.000001" class="form-control" id="location_x" name="location_x" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_y" class="form-label">Posizione Y</label>
                        <input type="number" step="0.000001" class="form-control" id="location_y" name="location_y" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icona</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="available_24h" name="available_24h">
                        <label class="form-check-label" for="available_24h">Disponibile 24h</label>
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label">Caratteristiche (JSON)</label>
                        <textarea class="form-control" id="features" name="features" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveServiceBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Servizio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm">
                    <input type="hidden" id="edit_service_id" name="id">
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
                        <label for="edit_location_x" class="form-label">Posizione X</label>
                        <input type="number" step="0.000001" class="form-control" id="edit_location_x" name="location_x" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location_y" class="form-label">Posizione Y</label>
                        <input type="number" step="0.000001" class="form-control" id="edit_location_y" name="location_y" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_icon" class="form-label">Icona</label>
                        <input type="text" class="form-control" id="edit_icon" name="icon">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="edit_available_24h" name="available_24h">
                        <label class="form-check-label" for="edit_available_24h">Disponibile 24h</label>
                    </div>
                    <div class="mb-3">
                        <label for="edit_features" class="form-label">Caratteristiche (JSON)</label>
                        <textarea class="form-control" id="edit_features" name="features" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateServiceBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>