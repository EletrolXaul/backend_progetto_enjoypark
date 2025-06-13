<!-- Add Ticket Type Modal -->
<div class="modal fade" id="addTicketTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Tipo di Biglietto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTicketTypeForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Seleziona tipo</option>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="vip">VIP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Prezzo (€)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="is_active" class="form-label">Stato</label>
                                <select class="form-select" id="is_active" name="is_active" required>
                                    <option value="1">Attivo</option>
                                    <option value="0">Inattivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label">Caratteristiche</label>
                        <div id="featuresContainer">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control feature-input" placeholder="Inserisci una caratteristica">
                                <button type="button" class="btn btn-outline-secondary add-feature">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Aggiungi le caratteristiche del tipo di biglietto</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveTicketTypeBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- View Ticket Type Modal -->
<div class="modal fade" id="viewTicketTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Tipo di Biglietto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Generali</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td id="view-id"></td>
                            </tr>
                            <tr>
                                <td><strong>Nome:</strong></td>
                                <td id="view-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Tipo:</strong></td>
                                <td id="view-type"></td>
                            </tr>
                            <tr>
                                <td><strong>Prezzo:</strong></td>
                                <td id="view-price"></td>
                            </tr>
                            <tr>
                                <td><strong>Stato:</strong></td>
                                <td id="view-status"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Descrizione</h6>
                        <p id="view-description" class="text-muted"></p>
                        
                        <h6>Caratteristiche</h6>
                        <div id="view-features"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Informazioni Aggiuntive</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Creato il:</strong></td>
                                <td id="view-created-at"></td>
                            </tr>
                            <tr>
                                <td><strong>Aggiornato il:</strong></td>
                                <td id="view-updated-at"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Ticket Type Modal -->
<div class="modal fade" id="editTicketTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Tipo di Biglietto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTicketTypeForm">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="edit-name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-type" class="form-label">Tipo</label>
                                <select class="form-select" id="edit-type" name="type" required>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="vip">VIP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-price" class="form-label">Prezzo (€)</label>
                                <input type="number" step="0.01" class="form-control" id="edit-price" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-is_active" class="form-label">Stato</label>
                                <select class="form-select" id="edit-is_active" name="is_active" required>
                                    <option value="1">Attivo</option>
                                    <option value="0">Inattivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-features" class="form-label">Caratteristiche</label>
                        <div id="editFeaturesContainer">
                            <!-- Features will be populated dynamically -->
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary add-edit-feature">
                            <i class="fas fa-plus"></i> Aggiungi Caratteristica
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateTicketTypeBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript per gestire le caratteristiche dinamiche
document.addEventListener('DOMContentLoaded', function() {
    // Add feature functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-feature')) {
            const container = document.getElementById('featuresContainer');
            const newFeature = document.createElement('div');
            newFeature.className = 'input-group mb-2';
            newFeature.innerHTML = `
                <input type="text" class="form-control feature-input" placeholder="Inserisci una caratteristica">
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newFeature);
        }
        
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.input-group').remove();
        }
    });
    
    // View ticket type functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-ticket-type')) {
            const button = e.target.closest('.view-ticket-type');
            const ticketTypeId = button.getAttribute('data-id');
            
            // Trova la riga della tabella per ottenere i dati
            const row = button.closest('tr');
            const cells = row.querySelectorAll('td');
            
            // Popola i campi del modal con i dati dalla tabella
            document.getElementById('view-id').textContent = cells[0].textContent;
            document.getElementById('view-name').textContent = cells[1].textContent;
            document.getElementById('view-type').textContent = cells[2].querySelector('.badge').textContent;
            document.getElementById('view-price').textContent = cells[3].textContent;
            
            // Descrizione completa dal title attribute
            const descriptionSpan = cells[4].querySelector('.text-truncate');
            const fullDescription = descriptionSpan ? descriptionSpan.getAttribute('title') : cells[4].textContent;
            document.getElementById('view-description').textContent = fullDescription || 'Nessuna descrizione';
            
            // Stato
            document.getElementById('view-status').innerHTML = cells[6].innerHTML;
            
            // Caratteristiche
            const featuresCell = cells[5];
            const featuresContainer = document.getElementById('view-features');
            
            if (featuresCell.querySelector('.features-list')) {
                const badges = featuresCell.querySelectorAll('.badge');
                let featuresHtml = '';
                badges.forEach(badge => {
                    featuresHtml += `<span class="badge bg-primary me-1 mb-1">${badge.textContent}</span>`;
                });
                
                // Aggiungi informazioni su caratteristiche aggiuntive se presenti
                const additionalText = featuresCell.querySelector('.text-muted');
                if (additionalText) {
                    featuresHtml += `<br><small class="text-muted">${additionalText.textContent}</small>`;
                }
                
                featuresContainer.innerHTML = featuresHtml;
            } else {
                featuresContainer.innerHTML = '<span class="text-muted">Nessuna caratteristica</span>';
            }
            
            // Data di creazione
            document.getElementById('view-created-at').textContent = cells[7].textContent;
            
            // Per ora impostiamo la data di aggiornamento uguale a quella di creazione
            // In futuro potresti aggiungere questo campo alla tabella o fare una chiamata AJAX
            document.getElementById('view-updated-at').textContent = cells[7].textContent;
        }
    });
});
</script>