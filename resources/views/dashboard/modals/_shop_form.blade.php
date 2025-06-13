<!-- Add Shop Modal -->
<div class="modal fade" id="addShopModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Negozio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addShopForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="opening_hours" class="form-label">Orario Apertura</label>
                            <input type="text" class="form-control" id="opening_hours" name="opening_hours" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="specialties" class="form-label">Specialità (JSON)</label>
                            <textarea class="form-control" id="specialties" name="specialties" rows="2" placeholder='["Souvenir", "Giocattoli", "Abbigliamento"]'></textarea>
                        </div>
                    </div>
                    
                    <!-- Campi nascosti per slug, coordinate casuali e immagine placeholder -->
                    <input type="hidden" id="slug" name="slug" value="">
                    <input type="hidden" id="location_x" name="location_x" value="">
                    <input type="hidden" id="location_y" name="location_y" value="">
                    <input type="hidden" id="image" name="image" value="/placeholder.jpg">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveShopBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Shop Modal -->
<div class="modal fade" id="editShopModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Negozio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editShopForm">
                    <input type="hidden" id="edit_shop_id" name="id">
                    <input type="hidden" id="edit_shop_slug" name="slug">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="edit_shop_name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="edit_shop_category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_shop_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_shop_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_opening_hours" class="form-label">Orario Apertura</label>
                            <input type="text" class="form-control" id="edit_shop_opening_hours" name="opening_hours" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_specialties" class="form-label">Specialità (JSON)</label>
                            <textarea class="form-control" id="edit_shop_specialties" name="specialties" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_location_x" class="form-label">Posizione X</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_shop_location_x" name="location_x" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_shop_location_y" class="form-label">Posizione Y</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_shop_location_y" name="location_y" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_shop_image" class="form-label">Immagine URL</label>
                        <input type="text" class="form-control" id="edit_shop_image" name="image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateShopBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>