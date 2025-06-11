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
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="Montagne Russe">Montagne Russe</option>
                            <option value="Acquatiche">Acquatiche</option>
                            <option value="Famiglia">Famiglia</option>
                            <option value="Simulatori">Simulatori</option>
                            <option value="Avventura">Avventura</option>
                        </select>
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
                    <div class="mb-3">
                        <label for="wait_time" class="form-label">Tempo di Attesa (minuti)</label>
                        <input type="number" class="form-control" id="wait_time" name="wait_time" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Stato</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="open">Aperto</option>
                            <option value="closed">Chiuso</option>
                            <option value="maintenance">Manutenzione</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thrill_level" class="form-label">Livello di Brivido (1-5)</label>
                        <input type="number" class="form-control" id="thrill_level" name="thrill_level" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_x" class="form-label">Posizione X</label>
                        <input type="number" class="form-control" id="location_x" name="location_x" step="0.000001" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_y" class="form-label">Posizione Y</label>
                        <input type="number" class="form-control" id="location_y" name="location_y" step="0.000001" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine (URL)</label>
                        <input type="text" class="form-control" id="image" name="image" placeholder="/placeholder.svg?height=200&width=300">
                        <small class="form-text text-muted">Lascia vuoto per usare l'immagine predefinita</small>
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label">Caratteristiche (JSON)</label>
                        <textarea class="form-control" id="features" name="features" rows="3" required placeholder='["Caratteristica 1", "Caratteristica 2"]'></textarea>
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
                        <label for="edit_category" class="form-label">Categoria</label>
                        <select class="form-control" id="edit_category" name="category" required>
                            <option value="Montagne Russe">Montagne Russe</option>
                            <option value="Acquatiche">Acquatiche</option>
                            <option value="Famiglia">Famiglia</option>
                            <option value="Simulatori">Simulatori</option>
                            <option value="Avventura">Avventura</option>
                        </select>
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
                    <div class="mb-3">
                        <label for="edit_wait_time" class="form-label">Tempo di Attesa (minuti)</label>
                        <input type="number" class="form-control" id="edit_wait_time" name="wait_time" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Stato</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="open">Aperto</option>
                            <option value="closed">Chiuso</option>
                            <option value="maintenance">Manutenzione</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_thrill_level" class="form-label">Livello di Brivido (1-5)</label>
                        <input type="number" class="form-control" id="edit_thrill_level" name="thrill_level" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location_x" class="form-label">Posizione X</label>
                        <input type="number" class="form-control" id="edit_location_x" name="location_x" step="0.000001" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location_y" class="form-label">Posizione Y</label>
                        <input type="number" class="form-control" id="edit_location_y" name="location_y" step="0.000001" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Immagine (URL)</label>
                        <input type="text" class="form-control" id="edit_image" name="image" placeholder="/placeholder.svg?height=200&width=300">
                        <small class="form-text text-muted">Lascia vuoto per usare l'immagine predefinita</small>
                    </div>
                    <div class="mb-3">
                        <label for="edit_features" class="form-label">Caratteristiche (JSON)</label>
                        <textarea class="form-control" id="edit_features" name="features" rows="3" required placeholder='["Caratteristica 1", "Caratteristica 2"]'></textarea>
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