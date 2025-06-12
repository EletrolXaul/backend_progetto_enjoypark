<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Servizio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addServiceForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="service_name" class="form-label">Nome*</label>
                            <input type="text" class="form-control" id="service_name" name="name" required>
                        </div>
                        <!-- Form Aggiungi Servizio - Categoria come input normale -->
                        <div class="col-md-6 mb-3">
                            <label for="service_category" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="service_category" name="category" required placeholder="Inserisci una categoria">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="service_description" class="form-label">Descrizione*</label>
                        <textarea class="form-control" id="service_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="service_location_x" class="form-label">Posizione X</label>
                            <input type="number" step="0.000001" class="form-control" id="service_location_x" name="location_x" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="service_location_y" class="form-label">Posizione Y</label>
                            <input type="number" step="0.000001" class="form-control" id="service_location_y" name="location_y" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="service_icon" class="form-label">Icona</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="service_icon" name="icon" value="🏢" readonly>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <!-- Nel form di aggiunta (intorno alla riga 61) -->
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-icon="🚻" data-target="icon">🚻 Servizi</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🍼" data-target="icon">🍼 Famiglia</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="ℹ️" data-target="icon">ℹ️ Informazioni</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🚗" data-target="icon">🚗 Parcheggio</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🏥" data-target="icon">🏥 Medico</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🔍" data-target="icon">🔍 Assistenza</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="♿" data-target="icon">♿ Accessibilità</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🔒" data-target="icon">🔒 Deposito</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="💳" data-target="icon">💳 Servizi Finanziari</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 form-check d-flex align-items-center">
                            <input type="checkbox" class="form-check-input" id="service_available_24h" name="available_24h">
                            <label class="form-check-label ms-2" for="service_available_24h">Disponibile 24h</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="features" class="form-label">Caratteristiche (JSON)*</label>
                        <textarea class="form-control" id="features" name="features" rows="3" placeholder='["Accessibile", "Gratuito", "Self-service"]'></textarea>
                    </div>
                    
                    <!-- Campo nascosto per slug -->
                    <input type="hidden" id="service_slug" name="slug" value="">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Servizio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm">
                    <input type="hidden" id="edit_service_id" name="id">
                    <input type="hidden" id="edit_slug" name="slug">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_name" class="form-label">Nome*</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <!-- Form Modifica Servizio - Categoria come input normale -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_category" class="form-label">Categoria*</label>
                            <input type="text" class="form-control" id="edit_category" name="category" required placeholder="Inserisci una categoria">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione*</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_location_x" class="form-label">Posizione X</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_location_x" name="location_x" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_location_y" class="form-label">Posizione Y</label>
                            <input type="number" step="0.000001" class="form-control" id="edit_location_y" name="location_y" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Per il dropdown delle icone nel form di modifica -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_icon" class="form-label">Icona</label>
                            <div class="input-group dropdown">
                                <input type="text" class="form-control" id="edit_icon" name="icon" readonly>
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-icon="🚻">🚻 Servizi</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🍼">🍼 Famiglia</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="ℹ️">ℹ️ Informazioni</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🚗">🚗 Parcheggio</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🏥">🏥 Medico</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🔍">🔍 Assistenza</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="♿">♿ Accessibilità</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="🔒">🔒 Deposito</a></li>
                                    <li><a class="dropdown-item" href="#" data-icon="💳">💳 Servizi Finanziari</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 form-check d-flex align-items-center">
                            <input type="checkbox" class="form-check-input" id="edit_available_24h" name="available_24h">
                            <label class="form-check-label ms-2" for="edit_available_24h">Disponibile 24h</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_features" class="form-label">Caratteristiche (JSON)*</label>
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