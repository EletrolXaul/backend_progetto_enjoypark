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
<<<<<<< HEAD
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="restaurant_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="restaurant_category" name="category" required>
                        </div>
=======
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
>>>>>>> parent of a82aab4 (correzioni di tutti i controller e delle  tabelle)
                    </div>
                    <div class="mb-3">
                        <label for="restaurant_description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="restaurant_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
<<<<<<< HEAD
                        <label class="form-label">Caratteristiche</label>
                        <div class="features-container">
                            <div class="feature-tags mb-2">
                                <div class="btn-group flex-wrap" role="group">
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-wifi" value="WiFi" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-wifi">WiFi</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-terrazza" value="Terrazza" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-terrazza">Terrazza</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-menu-bambini" value="Menu bambini" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-menu-bambini">Menu bambini</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-accessibile" value="Accessibile" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-accessibile">Accessibile</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-parcheggio" value="Parcheggio" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-parcheggio">Parcheggio</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-vegetariano" value="Opzioni vegetariane" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-vegetariano">Opzioni vegetariane</label>
                                    
                                    <input type="checkbox" class="btn-check feature-checkbox" id="feature-vegano" value="Opzioni vegane" autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm m-1" for="feature-vegano">Opzioni vegane</label>
                                </div>
                            </div>
                            <div class="custom-feature-input">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="new-feature" placeholder="Aggiungi caratteristica...">
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="add-feature-btn">Aggiungi</button>
                                </div>
                            </div>
                        </div>
                        <!-- <input type="hidden" id="restaurant_features" name="features"> -->
                    </div>
                    
                    <!-- Campi nascosti per slug, coordinate casuali e immagine placeholder -->
                    <input type="hidden" id="slug" name="slug" value="">
                    <input type="hidden" id="restaurant_location_x" name="location_x" value="">
                    <input type="hidden" id="restaurant_location_y" name="location_y" value="">
                    <input type="hidden" id="image" name="image" value="/placeholder.jpg">
=======
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
>>>>>>> parent of a82aab4 (correzioni di tutti i controller e delle  tabelle)
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
<<<<<<< HEAD
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_cuisine" class="form-label">Cucina</label>
                            <input type="text" class="form-control" id="edit_restaurant_cuisine" name="cuisine" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_restaurant_price_range" class="form-label">Fascia Prezzo</label>
                            <select class="form-control" id="edit_restaurant_price_range" name="price_range" required>
                                <option value="$">$ - Economico</option>
                                <option value="$$">$$ - Medio</option>
                                <option value="$$$">$$$ - Costoso</option>
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
                    
=======
>>>>>>> parent of a82aab4 (correzioni di tutti i controller e delle  tabelle)
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