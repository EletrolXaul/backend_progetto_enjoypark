<!-- Add Promo Code Modal -->
<div class="modal fade" id="addPromoCodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Codice Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPromoCodeForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="promo_code" class="form-label">Codice *</label>
                            <input type="text" class="form-control" id="promo_code" name="code" required>
                            <small class="form-text text-muted">Codice univoco per il promo</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="discount" class="form-label">Sconto (%) *</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="discount" name="discount" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="promo_code_description" class="form-label">Descrizione *</label>
                        <textarea class="form-control" id="promo_code_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="promo_type" class="form-label">Tipo *</label>
                            <select class="form-control" id="promo_type" name="type" required>
                                <option value="percentage">Percentuale</option>
                                <option value="fixed">Importo Fisso</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="promo_valid_until" class="form-label">Valido Fino A *</label>
                            <input type="date" class="form-control" id="promo_valid_until" name="valid_until" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="promo_min_amount" class="form-label">Importo Minimo (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="promo_min_amount" name="min_amount" placeholder="0.00">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="promo_max_discount" class="form-label">Sconto Massimo (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="promo_max_discount" name="max_discount" placeholder="0.00">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="promo_usage_limit" class="form-label">Limite Utilizzo</label>
                            <input type="number" min="0" class="form-control" id="promo_usage_limit" name="usage_limit" value="0">
                            <small class="form-text text-muted">0 = illimitato</small>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="promo_is_active" name="is_active" checked>
                        <label class="form-check-label" for="promo_is_active">Attivo</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="savePromoCodeBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Promo Code Modal -->
<div class="modal fade" id="editPromoCodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Codice Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPromoCodeForm">
                    <input type="hidden" id="edit_promo_code_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_promo_code" class="form-label">Codice *</label>
                            <input type="text" class="form-control" id="edit_promo_code" name="code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_discount" class="form-label">Sconto (%) *</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="edit_discount" name="discount" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrizione *</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_type" class="form-label">Tipo *</label>
                            <select class="form-control" id="edit_type" name="type" required>
                                <option value="percentage">Percentuale</option>
                                <option value="fixed">Importo Fisso</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_valid_until" class="form-label">Valido Fino A *</label>
                            <input type="date" class="form-control" id="edit_valid_until" name="valid_until" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="edit_min_amount" class="form-label">Importo Minimo (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="edit_min_amount" name="min_amount">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_max_discount" class="form-label">Sconto Massimo (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="edit_max_discount" name="max_discount">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_usage_limit" class="form-label">Limite Utilizzo</label>
                            <input type="number" min="0" class="form-control" id="edit_usage_limit" name="usage_limit">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_used_count" class="form-label">Utilizzato</label>
                            <input type="number" min="0" class="form-control" id="edit_used_count" name="used_count" readonly>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active">
                        <label class="form-check-label" for="edit_is_active">Attivo</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updatePromoCodeBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>