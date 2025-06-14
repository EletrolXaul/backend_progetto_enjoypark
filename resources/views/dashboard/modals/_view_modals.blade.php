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
</script>