<!-- Add Show Modal -->
<div class="modal fade" id="addShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Spettacolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addShowForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="show_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="show_description" name="description" rows="3" required></textarea>
                    </div>
<<<<<<< HEAD
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="venue" class="form-label">Luogo</label>
                            <input type="text" class="form-control" id="venue" name="venue" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="show_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="show_category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="time" class="form-label">Orario</label>
                            <input type="time" class="form-control" id="time" name="times[]" required>
                            <small class="text-muted">Verrà salvato come array</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="show_duration" class="form-label">Durata (minuti)</label>
                            <input type="number" class="form-control" id="show_duration" name="duration" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Prezzo</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="show_capacity" class="form-label">Capacità</label>
                            <input type="number" class="form-control" id="show_capacity" name="capacity" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="available_seats" class="form-label">Posti disponibili</label>
                            <input type="number" class="form-control" id="available_seats" name="available_seats" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="age_restriction" class="form-label">Restrizione età</label>
                            <input type="text" class="form-control" id="age_restriction" name="age_restriction" required>
                        </div>
                    </div>
                    
                    <!-- Campi nascosti per coordinate casuali e immagine placeholder -->
                    <input type="hidden" id="show_location_x" name="location_x" value="">
                    <input type="hidden" id="show_location_y" name="location_y" value="">
                    <input type="hidden" id="image" name="image" value="/placeholder.jpg">
=======
                    <div class="mb-3">
                        <label for="time" class="form-label">Orario</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Durata (minuti)</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Luogo</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
>>>>>>> parent of a82aab4 (correzioni di tutti i controller e delle  tabelle)
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveShowBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Show Modal -->
<div class="modal fade" id="editShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Spettacolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editShowForm">
                    <input type="hidden" id="edit_show_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_time" class="form-label">Orario</label>
                        <input type="time" class="form-control" id="edit_time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_duration" class="form-label">Durata (minuti)</label>
                        <input type="number" class="form-control" id="edit_duration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location" class="form-label">Luogo</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateShowBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>