<!-- Add Restaurant Modal -->
<div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Ristorante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRestaurantForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cuisine_type" class="form-label">Tipo Cucina</label>
                        <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacità</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="opening_hours" class="form-label">Orario Apertura</label>
                        <input type="text" class="form-control" id="opening_hours" name="opening_hours" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveRestaurantBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Restaurant Modal -->
<div class="modal fade" id="editRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Ristorante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRestaurantForm">
                    <input type="hidden" id="edit_restaurant_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_cuisine_type" class="form-label">Tipo Cucina</label>
                        <input type="text" class="form-control" id="edit_cuisine_type" name="cuisine_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_capacity" class="form-label">Capacità</label>
                        <input type="number" class="form-control" id="edit_capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_opening_hours" class="form-label">Orario Apertura</label>
                        <input type="text" class="form-control" id="edit_opening_hours" name="opening_hours" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateRestaurantBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>