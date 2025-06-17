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