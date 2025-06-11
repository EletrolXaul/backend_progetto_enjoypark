<!-- Add Restaurant Modal -->
<div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Ristorante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRestaurantForm">
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
                            <label for="cuisine" class="form-label">Tipo Cucina</label>
                            <input type="text" class="form-control" id="cuisine" name="cuisine" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_range" class="form-label">Fascia Prezzo</label>
                            <select class="form-control" id="price_range" name="price_range" required>
                                <option value="$">$ - Economico</option>
                                <option value="$$">$$ - Medio</option>
                                <option value="$$$">$$$ - Costoso</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" step="0.1" min="0" max="5" class="form-control" id="rating" name="rating" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="opening_hours" class="form-label">Orario Apertura</label>
                            <div class="opening-hours-container">
                                <div class="day-selector mb-2">
                                    <div class="btn-group w-100" role="group">
                                        <input type="checkbox" class="btn-check" id="day-lun" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-lun">Lun</label>
                                        <input type="checkbox" class="btn-check" id="day-mar" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-mar">Mar</label>
                                        <input type="checkbox" class="btn-check" id="day-mer" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-mer">Mer</label>
                                        <input type="checkbox" class="btn-check" id="day-gio" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-gio">Gio</label>
                                        <input type="checkbox" class="btn-check" id="day-ven" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-ven">Ven</label>
                                        <input type="checkbox" class="btn-check" id="day-sab" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-sab">Sab</label>
                                        <input type="checkbox" class="btn-check" id="day-dom" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary btn-sm" for="day-dom">Dom</label>
                                    </div>
                                </div>
                                <div class="time-selector d-flex">
                                    <div class="me-2">
                                        <label class="form-label small">Apertura</label>
                                        <input type="time" class="form-control form-control-sm" id="opening_time" value="09:00">
                                    </div>
                                    <div>
                                        <label class="form-label small">Chiusura</label>
                                        <input type="time" class="form-control form-control-sm" id="closing_time" value="22:00">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="opening_hours" name="opening_hours">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Caratteristiche</label>
                        <div class="features-container">
                            <div class="feature-tags mb-2">
                                <div class="btn-group flex-wrap" role="group">
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-wifi" value="WiFi" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-wifi">WiFi</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-terrazza" value="Terrazza" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-terrazza">Terrazza</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-menu-bambini" value="Menu bambini" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-menu-bambini">Menu bambini</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-accessibile" value="Accessibile" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-accessibile">Accessibile</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-parcheggio" value="Parcheggio" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-parcheggio">Parcheggio</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-vegetariano" value="Opzioni vegetariane" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-vegetariano">Opzioni vegetariane</label>
                                    
                                    <input type="checkbox" class="btn-check edit-feature-checkbox" id="edit-feature-vegano" value="Opzioni vegane" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="edit-feature-vegano">Opzioni vegane</label>
                                </div>
                            </div>
                            <div class="custom-feature-input">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="edit-new-feature" placeholder="Aggiungi caratteristica...">
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="edit-add-feature-btn">Aggiungi</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="edit_features" name="features">
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
                <button type="button" class="btn btn-primary" id="saveRestaurantBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Restaurant Modal -->
<div class="modal fade" id="editRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Ristorante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRestaurantForm">
                    <input type="hidden" id="edit_restaurant_id" name="id">
                    <input type="hidden" id="edit_restaurant_slug" name="slug">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="edit_restaurant_name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="edit_restaurant_category" name="category" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_restaurant_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit_restaurant_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_cuisine" class="form-label">Cucina</label>
                            <input type="text" class="form-control" id="edit_restaurant_cuisine" name="cuisine" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_price_range" class="form-label">Fascia Prezzo</label>
                            <select class="form-control" id="edit_restaurant_price_range" name="price_range" required>
                                <option value="€">€ - Economico</option>
                                <option value="€€">€€ - Medio</option>
                                <option value="€€€">€€€ - Costoso</option>
                                <option value="€€€€">€€€€ - Molto Costoso</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_rating" class="form-label">Rating (1-5)</label>
                            <input type="number" step="0.1" min="1" max="5" class="form-control" id="edit_restaurant_rating" name="rating" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_opening_hours" class="form-label">Orario Apertura</label>
                            <input type="text" class="form-control" id="edit_restaurant_opening_hours" name="opening_hours" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_location_x" class="form-label">Posizione X</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_restaurant_location_x" name="location_x" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_location_y" class="form-label">Posizione Y</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_restaurant_location_y" name="location_y" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_restaurant_image" class="form-label">Immagine URL</label>
                        <input type="text" class="form-control" id="edit_restaurant_image" name="image">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Caratteristiche</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_wifi" name="features[]" value="WiFi">
                                    <label class="form-check-label" for="edit_wifi">WiFi</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_parking" name="features[]" value="Parcheggio">
                                    <label class="form-check-label" for="edit_parking">Parcheggio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_accessible" name="features[]" value="Accessibile">
                                    <label class="form-check-label" for="edit_accessible">Accessibile</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_outdoor" name="features[]" value="Posti all'aperto">
                                    <label class="form-check-label" for="edit_outdoor">Posti all'aperto</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_takeaway" name="features[]" value="Asporto">
                                    <label class="form-check-label" for="edit_takeaway">Asporto</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_delivery" name="features[]" value="Consegna">
                                    <label class="form-check-label" for="edit_delivery">Consegna</label>
                                </div>
                            </div>
                        </div>
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