<!-- View Restaurant Modal -->
<div class="modal fade" id="viewRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Ristorante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Generali</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td id="view-restaurant-id"></td>
                            </tr>
                            <tr>
                                <td><strong>Nome:</strong></td>
                                <td id="view-restaurant-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Categoria:</strong></td>
                                <td id="view-restaurant-category"></td>
                            </tr>
                            <tr>
                                <td><strong>Cucina:</strong></td>
                                <td id="view-restaurant-cuisine"></td>
                            </tr>
                            <tr>
                                <td><strong>Fascia Prezzo:</strong></td>
                                <td id="view-restaurant-price-range"></td>
                            </tr>
                            <tr>
                                <td><strong>Rating:</strong></td>
                                <td id="view-restaurant-rating"></td>
                            </tr>
                            <tr>
                                <td><strong>Orario Apertura:</strong></td>
                                <td id="view-restaurant-opening-hours"></td>
                            </tr>
                            <tr>
                                <td><strong>Posizione:</strong></td>
                                <td id="view-restaurant-location"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Descrizione</h6>
                        <p id="view-restaurant-description" class="text-muted"></p>
                        
                        <h6>Caratteristiche</h6>
                        <div id="view-restaurant-features"></div>
                        
                        <h6>Immagine</h6>
                        <div id="view-restaurant-image"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Informazioni Aggiuntive</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Creato il:</strong></td>
                                <td id="view-restaurant-created-at"></td>
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

<!-- View Shop Modal -->
<div class="modal fade" id="viewShopModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Negozio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Generali</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td id="view-shop-id"></td>
                            </tr>
                            <tr>
                                <td><strong>Nome:</strong></td>
                                <td id="view-shop-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Categoria:</strong></td>
                                <td id="view-shop-category"></td>
                            </tr>
                            <tr>
                                <td><strong>Orario Apertura:</strong></td>
                                <td id="view-shop-opening-hours"></td>
                            </tr>
                            <tr>
                                <td><strong>Posizione:</strong></td>
                                <td id="view-shop-location"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Descrizione</h6>
                        <p id="view-shop-description" class="text-muted"></p>
                        
                        <h6>Specialità</h6>
                        <div id="view-shop-specialties"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Informazioni Aggiuntive</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Creato il:</strong></td>
                                <td id="view-shop-created-at"></td>
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

<!-- View Service Modal -->
<div class="modal fade" id="viewServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Servizio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Generali</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td id="view-service-id"></td>
                            </tr>
                            <tr>
                                <td><strong>Nome:</strong></td>
                                <td id="view-service-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Categoria:</strong></td>
                                <td id="view-service-category"></td>
                            </tr>
                            <tr>
                                <td><strong>Icona:</strong></td>
                                <td id="view-service-icon"></td>
                            </tr>
                            <tr>
                                <td><strong>Disponibile 24h:</strong></td>
                                <td id="view-service-available-24h"></td>
                            </tr>
                            <tr>
                                <td><strong>Posizione:</strong></td>
                                <td id="view-service-location"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Descrizione</h6>
                        <p id="view-service-description" class="text-muted"></p>
                        
                        <h6>Caratteristiche</h6>
                        <div id="view-service-features"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Informazioni Aggiuntive</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Creato il:</strong></td>
                                <td id="view-service-created-at"></td>
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

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Utente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Generali</h6>
                        <table class="table table-borderless">
                            <tr><td><strong>ID:</strong></td><td id="view-user-id"></td></tr>
                            <tr><td><strong>Nome:</strong></td><td id="view-user-name"></td></tr>
                            <tr><td><strong>Email:</strong></td><td id="view-user-email"></td></tr>
                            <tr><td><strong>Amministratore:</strong></td><td id="view-user-admin"></td></tr>
                            <tr><td><strong>Registrato il:</strong></td><td id="view-user-created"></td></tr>
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

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Ordine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informazioni Ordine</h6>
                        <table class="table table-borderless">
                            <tr><td><strong>ID:</strong></td><td id="view-order-id"></td></tr>
                            <tr><td><strong>Numero Ordine:</strong></td><td id="view-order-number"></td></tr>
                            <tr><td><strong>Utente:</strong></td><td id="view-order-user"></td></tr>
                            <tr><td><strong>Prezzo Totale:</strong></td><td id="view-order-total"></td></tr>
                            <tr><td><strong>Stato:</strong></td><td id="view-order-status"></td></tr>
                            <tr><td><strong>Data Creazione:</strong></td><td id="view-order-created"></td></tr>
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
// View restaurant functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-restaurant') || e.target.closest('.view-restaurant')) {
        const button = e.target.closest('.view-restaurant');
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td');
        
        document.getElementById('view-restaurant-id').textContent = cells[0].textContent;
        document.getElementById('view-restaurant-name').textContent = button.dataset.name;
        document.getElementById('view-restaurant-category').textContent = button.dataset.category;
        document.getElementById('view-restaurant-cuisine').textContent = button.dataset.cuisine;
        document.getElementById('view-restaurant-price-range').textContent = button.dataset.priceRange;
        document.getElementById('view-restaurant-rating').textContent = button.dataset.rating + '/5';
        document.getElementById('view-restaurant-opening-hours').textContent = button.dataset.openingHours;
        document.getElementById('view-restaurant-location').textContent = '(' + button.dataset.locationX + ', ' + button.dataset.locationY + ')';
        document.getElementById('view-restaurant-description').textContent = button.dataset.description;
        
        // Gestione features
        const featuresContainer = document.getElementById('view-restaurant-features');
        try {
            const features = JSON.parse(button.dataset.features);
            if (features && features.length > 0) {
                featuresContainer.innerHTML = '';
                features.forEach(feature => {
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-secondary me-1';
                    badge.textContent = feature;
                    featuresContainer.appendChild(badge);
                });
            } else {
                featuresContainer.innerHTML = '<span class="text-muted">Nessuna caratteristica</span>';
            }
        } catch (e) {
            featuresContainer.innerHTML = '<span class="text-muted">Nessuna caratteristica</span>';
        }
        
        document.getElementById('view-restaurant-created-at').textContent = cells[8].textContent;
        
        // Mostra l'immagine se disponibile
        const imageContainer = document.getElementById('view-restaurant-image');
        if (button.dataset.image) {
            imageContainer.innerHTML = `<img src="${button.dataset.image}" class="img-fluid rounded" alt="${button.dataset.name}">`;
        } else {
            imageContainer.innerHTML = '<span class="text-muted">Nessuna immagine disponibile</span>';
        }
        
        $('#viewRestaurantModal').modal('show');
    }
});

// View shop functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-shop') || e.target.closest('.view-shop')) {
        const button = e.target.closest('.view-shop');
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td');
        
        document.getElementById('view-shop-id').textContent = cells[0].textContent;
        document.getElementById('view-shop-name').textContent = button.dataset.name;
        document.getElementById('view-shop-category').textContent = button.dataset.category;
        document.getElementById('view-shop-opening-hours').textContent = button.dataset.openingHours;
        document.getElementById('view-shop-location').textContent = '(' + button.dataset.locationX + ', ' + button.dataset.locationY + ')';
        document.getElementById('view-shop-description').textContent = button.dataset.description;
        
        // Gestione specialties
        const specialtiesContainer = document.getElementById('view-shop-specialties');
        try {
            const specialties = JSON.parse(button.dataset.specialties);
            if (specialties && specialties.length > 0) {
                specialtiesContainer.innerHTML = '';
                specialties.forEach(specialty => {
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-secondary me-1';
                    badge.textContent = specialty;
                    specialtiesContainer.appendChild(badge);
                });
            } else {
                specialtiesContainer.innerHTML = '<span class="text-muted">Nessuna specialità</span>';
            }
        } catch (e) {
            specialtiesContainer.innerHTML = '<span class="text-muted">Nessuna specialità</span>';
        }
        
        document.getElementById('view-shop-created-at').textContent = cells[7].textContent;
        
        $('#viewShopModal').modal('show');
    }
});

// View service functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-service') || e.target.closest('.view-service')) {
        const button = e.target.closest('.view-service');
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td');
        
        document.getElementById('view-service-id').textContent = cells[0].textContent;
        document.getElementById('view-service-name').textContent = button.dataset.name;
        document.getElementById('view-service-category').textContent = button.dataset.category;
        document.getElementById('view-service-icon').innerHTML = `<i class="${button.dataset.icon}"></i> ${button.dataset.icon}`;
        document.getElementById('view-service-available-24h').textContent = button.dataset.available24h === 'true' ? 'Sì' : 'No';
        document.getElementById('view-service-location').textContent = '(' + button.dataset.locationX + ', ' + button.dataset.locationY + ')';
        document.getElementById('view-service-description').textContent = button.dataset.description;
        
        // Gestione features
        const featuresContainer = document.getElementById('view-service-features');
        try {
            const features = JSON.parse(button.dataset.features);
            if (features && features.length > 0) {
                featuresContainer.innerHTML = '';
                features.forEach(feature => {
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-secondary me-1';
                    badge.textContent = feature;
                    featuresContainer.appendChild(badge);
                });
            } else {
                featuresContainer.innerHTML = '<span class="text-muted">Nessuna caratteristica</span>';
            }
        } catch (e) {
            featuresContainer.innerHTML = '<span class="text-muted">Nessuna caratteristica</span>';
        }
        
        document.getElementById('view-service-created-at').textContent = cells[8].textContent;
        
        $('#viewServiceModal').modal('show');
    }
});

// Ticket View Modal
function showTicketDetails(button) {
    const ticketData = {
        id: button.getAttribute('data-id'),
        code: button.getAttribute('data-code'),
        type: button.getAttribute('data-type'),
        price: button.getAttribute('data-price'),
        purchaseDate: button.getAttribute('data-purchase-date'),
        validDate: button.getAttribute('data-valid-date'),
        status: button.getAttribute('data-status'),
        user: button.getAttribute('data-user')
    };
    
    document.getElementById('view-ticket-id').textContent = ticketData.id;
    document.getElementById('view-ticket-code').textContent = ticketData.code;
    document.getElementById('view-ticket-type').textContent = ticketData.type;
    document.getElementById('view-ticket-price').textContent = ticketData.price;
    document.getElementById('view-ticket-purchase-date').textContent = ticketData.purchaseDate;
    document.getElementById('view-ticket-valid-date').textContent = ticketData.validDate;
    document.getElementById('view-ticket-status').textContent = ticketData.status;
    document.getElementById('view-ticket-user').textContent = ticketData.user;
    
    new bootstrap.Modal(document.getElementById('viewTicketModal')).show();
}

// Attraction View Modal
function showAttractionDetails(button) {
    const attractionData = {
        id: button.getAttribute('data-id'),
        name: button.getAttribute('data-name'),
        type: button.getAttribute('data-type'),
        duration: button.getAttribute('data-duration'),
        capacity: button.getAttribute('data-capacity'),
        minHeight: button.getAttribute('data-min-height'),
        status: button.getAttribute('data-status'),
        zone: button.getAttribute('data-zone'),
        description: button.getAttribute('data-description')
    };
    
    document.getElementById('view-attraction-id').textContent = attractionData.id;
    document.getElementById('view-attraction-name').textContent = attractionData.name;
    document.getElementById('view-attraction-type').textContent = attractionData.type;
    document.getElementById('view-attraction-duration').textContent = attractionData.duration;
    document.getElementById('view-attraction-capacity').textContent = attractionData.capacity;
    document.getElementById('view-attraction-min-height').textContent = attractionData.minHeight;
    document.getElementById('view-attraction-status').textContent = attractionData.status;
    document.getElementById('view-attraction-zone').textContent = attractionData.zone;
    document.getElementById('view-attraction-description').textContent = attractionData.description;
    
    new bootstrap.Modal(document.getElementById('viewAttractionModal')).show();
}

// Show View Modal
function showShowDetails(button) {
    const showData = {
        id: button.getAttribute('data-id'),
        name: button.getAttribute('data-name'),
        duration: button.getAttribute('data-duration'),
        capacity: button.getAttribute('data-capacity'),
        startTime: button.getAttribute('data-start-time'),
        endTime: button.getAttribute('data-end-time'),
        status: button.getAttribute('data-status'),
        zone: button.getAttribute('data-zone'),
        description: button.getAttribute('data-description')
    };
    
    document.getElementById('view-show-id').textContent = showData.id;
    document.getElementById('view-show-name').textContent = showData.name;
    document.getElementById('view-show-duration').textContent = showData.duration;
    document.getElementById('view-show-capacity').textContent = showData.capacity;
    document.getElementById('view-show-start-time').textContent = showData.startTime;
    document.getElementById('view-show-end-time').textContent = showData.endTime;
    document.getElementById('view-show-status').textContent = showData.status;
    document.getElementById('view-show-zone').textContent = showData.zone;
    document.getElementById('view-show-description').textContent = showData.description;
    
    new bootstrap.Modal(document.getElementById('viewShowModal')).show();
}

// Promo Code View Modal
function showPromoCodeDetails(button) {
    const promoData = {
        id: button.getAttribute('data-id'),
        code: button.getAttribute('data-code'),
        discount: button.getAttribute('data-discount'),
        type: button.getAttribute('data-type'),
        startDate: button.getAttribute('data-start-date'),
        endDate: button.getAttribute('data-end-date'),
        maxUses: button.getAttribute('data-max-uses'),
        currentUses: button.getAttribute('data-current-uses'),
        description: button.getAttribute('data-description')
    };
    
    document.getElementById('view-promo-id').textContent = promoData.id;
    document.getElementById('view-promo-code').textContent = promoData.code;
    document.getElementById('view-promo-discount').textContent = promoData.discount;
    document.getElementById('view-promo-type').textContent = promoData.type;
    document.getElementById('view-promo-start-date').textContent = promoData.startDate;
    document.getElementById('view-promo-end-date').textContent = promoData.endDate;
    document.getElementById('view-promo-max-uses').textContent = promoData.maxUses;
    document.getElementById('view-promo-current-uses').textContent = promoData.currentUses;
    document.getElementById('view-promo-description').textContent = promoData.description;
    
    new bootstrap.Modal(document.getElementById('viewPromoCodeModal')).show();
}

// Visit History View Modal
function showVisitDetails(button) {
    const visitData = {
        id: button.getAttribute('data-id'),
        user: button.getAttribute('data-user'),
        attraction: button.getAttribute('data-attraction'),
        date: button.getAttribute('data-date'),
        entryTime: button.getAttribute('data-entry-time'),
        exitTime: button.getAttribute('data-exit-time'),
        duration: button.getAttribute('data-duration'),
        rating: button.getAttribute('data-rating')
    };
    
    document.getElementById('view-visit-id').textContent = visitData.id;
    document.getElementById('view-visit-user').textContent = visitData.user;
    document.getElementById('view-visit-attraction').textContent = visitData.attraction;
    document.getElementById('view-visit-date').textContent = visitData.date;
    document.getElementById('view-visit-entry-time').textContent = visitData.entryTime;
    document.getElementById('view-visit-exit-time').textContent = visitData.exitTime;
    document.getElementById('view-visit-duration').textContent = visitData.duration;
    document.getElementById('view-visit-rating').textContent = visitData.rating;
    
    new bootstrap.Modal(document.getElementById('viewVisitModal')).show();
}

// Credit Card View Modal
function showCreditCardDetails(button) {
    const cardData = {
        id: button.getAttribute('data-id'),
        user: button.getAttribute('data-user'),
        number: button.getAttribute('data-number'),
        type: button.getAttribute('data-type'),
        expiry: button.getAttribute('data-expiry'),
        holder: button.getAttribute('data-holder'),
        isDefault: button.getAttribute('data-default'),
        created: button.getAttribute('data-created')
    };
    
    document.getElementById('view-card-id').textContent = cardData.id;
    document.getElementById('view-card-user').textContent = cardData.user;
    document.getElementById('view-card-number').textContent = cardData.number;
    document.getElementById('view-card-type').textContent = cardData.type;
    document.getElementById('view-card-expiry').textContent = cardData.expiry;
    document.getElementById('view-card-holder').textContent = cardData.holder;
    document.getElementById('view-card-default').textContent = cardData.isDefault === 'true' ? 'Sì' : 'No';
    document.getElementById('view-card-created').textContent = cardData.created;
    
    new bootstrap.Modal(document.getElementById('viewCreditCardModal')).show();
}
</script>