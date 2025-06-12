<!-- Add Ticket Modal -->
<div class="modal fade" id="addTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuovo Biglietto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTicketForm">
                    <div class="mb-3">
                        <label for="ticket_code" class="form-label">Codice</label>
                        <input type="text" class="form-control" id="ticket_code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="validity_date" class="form-label">Data di Validità</label>
                        <input type="date" class="form-control" id="validity_date" name="validity_date" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveTicketBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Ticket Modal -->
<div class="modal fade" id="editTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Biglietto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTicketForm">
                    <input type="hidden" id="edit_ticket_id" name="id">
                    <div class="mb-3">
                        <label for="edit_code" class="form-label">Codice</label>
                        <input type="text" class="form-control" id="edit_code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Tipo</label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Prezzo</label>
                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_validity_date" class="form-label">Data di Validità</label>
                        <input type="date" class="form-control" id="edit_validity_date" name="validity_date" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateTicketBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>