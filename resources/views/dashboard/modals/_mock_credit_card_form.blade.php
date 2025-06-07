<!-- Add Mock Credit Card Modal -->
<div class="modal fade" id="addMockCreditCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuova Carta di Credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMockCreditCardForm">
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero Carta</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Titolare</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiry" class="form-label">Data Scadenza (MM/AA)</label>
                        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/AA" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="amex">American Express</option>
                            <option value="discover">Discover</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="result" class="form-label">Risultato</label>
                        <select class="form-control" id="result" name="result" required>
                            <option value="success">Successo</option>
                            <option value="declined">Rifiutata</option>
                            <option value="error">Errore</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Messaggio</label>
                        <input type="text" class="form-control" id="message" name="message">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveMockCreditCardBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Mock Credit Card Modal -->
<div class="modal fade" id="editMockCreditCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Carta di Credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMockCreditCardForm">
                    <input type="hidden" id="edit_mock_credit_card_id" name="id">
                    <div class="mb-3">
                        <label for="edit_number" class="form-label">Numero Carta</label>
                        <input type="text" class="form-control" id="edit_number" name="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome Titolare</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_expiry" class="form-label">Data Scadenza (MM/AA)</label>
                        <input type="text" class="form-control" id="edit_expiry" name="expiry" placeholder="MM/AA" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="edit_cvv" name="cvv" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Tipo</label>
                        <select class="form-control" id="edit_type" name="type" required>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="amex">American Express</option>
                            <option value="discover">Discover</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_result" class="form-label">Risultato</label>
                        <select class="form-control" id="edit_result" name="result" required>
                            <option value="success">Successo</option>
                            <option value="declined">Rifiutata</option>
                            <option value="error">Errore</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_message" class="form-label">Messaggio</label>
                        <input type="text" class="form-control" id="edit_message" name="message">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateMockCreditCardBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>