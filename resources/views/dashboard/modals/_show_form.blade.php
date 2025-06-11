<!-- Add Show Modal -->
<div class="modal fade" id="addShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Spettacolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addShowForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="venue" class="form-label">Luogo</label>
                            <input type="text" class="form-control" id="venue" name="venue" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="time" class="form-label">Orario</label>
                            <input type="time" class="form-control" id="time" name="times[]" required>
                            <small class="text-muted">Verrà salvato come array</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="duration" class="form-label">Durata (minuti)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Prezzo</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="capacity" class="form-label">Capacità</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
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
                    <input type="hidden" id="location_x" name="location_x" value="">
                    <input type="hidden" id="location_y" name="location_y" value="">
                    <input type="hidden" id="image" name="image" value="/placeholder.jpg">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Spettacolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editShowForm">
                    <input type="hidden" id="edit_show_id" name="id">
                    <input type="hidden" id="edit_show_slug" name="slug">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="edit_show_name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="edit_show_category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_show_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_show_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_venue" class="form-label">Venue</label>
                            <input type="text" class="form-control" id="edit_show_venue" name="venue" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_times" class="form-label">Orari (separati da virgola)</label>
                            <input type="text" class="form-control" id="edit_show_times" name="times" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_duration" class="form-label">Durata (minuti)</label>
                            <input type="number" class="form-control" id="edit_show_duration" name="duration" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_capacity" class="form-label">Capacità</label>
                            <input type="number" class="form-control" id="edit_show_capacity" name="capacity" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_available_seats" class="form-label">Posti Disponibili</label>
                            <input type="number" class="form-control" id="edit_show_available_seats" name="available_seats" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_price" class="form-label">Prezzo (€)</label>
                            <input type="number" step="0.01" class="form-control" id="edit_show_price" name="price" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_rating" class="form-label">Rating (1-5)</label>
                            <input type="number" step="0.1" min="1" max="5" class="form-control" id="edit_show_rating" name="rating" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_show_age_restriction" class="form-label">Età Minima</label>
                            <input type="number" class="form-control" id="edit_show_age_restriction" name="age_restriction" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_location_x" class="form-label">Posizione X</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_show_location_x" name="location_x" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_show_location_y" class="form-label">Posizione Y</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_show_location_y" name="location_y" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_show_image" class="form-label">Immagine URL</label>
                        <input type="text" class="form-control" id="edit_show_image" name="image">
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