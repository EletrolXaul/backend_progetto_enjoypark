<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Ordine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOrderForm">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Utente</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="total_price" class="form-label">Prezzo Totale</label>
                        <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" required>
                    </div>
                    <!-- Nel form di aggiunta -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Stato</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending">In attesa</option>
                            <option value="confirmed">Confermato</option>
                            <option value="used">Utilizzato</option>
                            <option value="expired">Scaduto</option>
                        </select>
                    </div>
                    
                    <!-- Nel form di modifica -->
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Stato</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="pending">In attesa</option>
                            <option value="confirmed">Confermato</option>
                            <option value="used">Utilizzato</option>
                            <option value="expired">Scaduto</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Stato</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="pending">In attesa</option>
                            <option value="completed">Completato</option>
                            <option value="cancelled">Annullato</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveOrderBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Ordine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOrderForm">
                    <input type="hidden" id="edit_order_id" name="id">
                    <div class="mb-3">
                        <label for="edit_user_id" class="form-label">Utente</label>
                        <select class="form-select" id="edit_user_id" name="user_id" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_total_price" class="form-label">Prezzo Totale</label>
                        <input type="number" step="0.01" class="form-control" id="edit_total_price" name="total_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Stato</label>
                        <select class="form-select" id="order_edit_status" name="status" required>
                            <option value="pending">In attesa</option>
                            <option value="completed">Completato</option>
                            <option value="cancelled">Annullato</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateOrderBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>