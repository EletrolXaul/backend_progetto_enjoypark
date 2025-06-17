<!-- Modal Dettagli Completi -->
<div class="modal fade" id="creditCardDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Completi Carta di Credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-user me-2"></i>Informazioni Utente</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Nome:</strong> <span id="detail_user_name">-</span></p>
                                <p><strong>Email:</strong> <span id="detail_user_email">-</span></p>
                                <p><strong>ID Utente:</strong> <span id="detail_user_id">-</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="fas fa-credit-card me-2"></i>Dettagli Carta</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Numero Completo:</strong> <code id="detail_card_number">-</code></p>
                                <p><strong>Titolare:</strong> <span id="detail_cardholder_name">-</span></p>
                                <p><strong>CVV:</strong> <code id="detail_cvv">-</code></p>
                                <p><strong>Scadenza:</strong> <span id="detail_expiry">-</span></p>
                                <p><strong>Tipo:</strong> <span id="detail_card_type">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="fas fa-euro-sign me-2"></i>Informazioni Finanziarie</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Saldo Disponibile:</strong> <span class="text-success fw-bold">€<span id="detail_balance">0.00</span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Simulazione Test</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Risultato:</strong> <span id="detail_result_badge">-</span></p>
                                <p><strong>Messaggio:</strong> <span id="detail_message">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card border-secondary">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informazioni Sistema</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>ID Carta:</strong> <span id="detail_card_id">-</span></p>
                                <p><strong>Data Creazione:</strong> <span id="detail_created_at">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>