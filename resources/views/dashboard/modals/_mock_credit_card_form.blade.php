<!-- Add Mock Credit Card Modal -->
<div class="modal fade" id="addMockCreditCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuova Carta di Credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMockCreditCardForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Utente</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">Nessun utente associato</option>
                                @foreach($users ?? [] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="card_number" class="form-label">Numero Carta *</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                            <small class="form-text text-muted">16 cifre senza spazi</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cardholder_name" class="form-label">Nome Titolare *</label>
                            <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Mario Rossi" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="expiry" class="form-label">Scadenza *</label>
                            <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" pattern="[0-9]{2}/[0-9]{2}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cvv" class="form-label">CVV *</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" maxlength="4" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="card_type" class="form-label">Tipo Carta</label>
                            <select class="form-control" id="card_type" name="card_type">
                                <option value="visa">Visa</option>
                                <option value="mastercard">Mastercard</option>
                                <option value="amex">American Express</option>
                                <option value="discover">Discover</option>
                                <option value="other">Altro</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="balance" class="form-label">Saldo Disponibile (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="balance" name="balance" placeholder="1000.00">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="result" class="form-label">Risultato Simulazione *</label>
                            <select class="form-control" id="result" name="result" required>
                                <option value="success">✅ Successo</option>
                                <option value="declined">❌ Rifiutata</option>
                                <option value="error">⚠️ Errore</option>
                                <option value="insufficient_funds">💳 Fondi Insufficienti</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="message" class="form-label">Messaggio</label>
                            <input type="text" class="form-control" id="message" name="message" placeholder="Messaggio di risposta">
                        </div>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Carta di Credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMockCreditCardForm">
                    <input type="hidden" id="edit_mock_credit_card_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_user_id" class="form-label">Utente</label>
                            <select class="form-control" id="edit_user_id" name="user_id">
                                <option value="">Nessun utente associato</option>
                                @foreach($users ?? [] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_card_number" class="form-label">Numero Carta *</label>
                            <input type="text" class="form-control" id="edit_card_number" name="card_number" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_cardholder_name" class="form-label">Nome Titolare *</label>
                            <input type="text" class="form-control" id="edit_cardholder_name" name="cardholder_name" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_expiry" class="form-label">Scadenza *</label>
                            <input type="text" class="form-control" id="edit_expiry" name="expiry" pattern="[0-9]{2}/[0-9]{2}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_cvv" class="form-label">CVV *</label>
                            <input type="text" class="form-control" id="edit_cvv" name="cvv" maxlength="4" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_card_type" class="form-label">Tipo Carta</label>
                            <select class="form-control" id="edit_card_type" name="card_type">
                                <option value="visa">Visa</option>
                                <option value="mastercard">Mastercard</option>
                                <option value="amex">American Express</option>
                                <option value="discover">Discover</option>
                                <option value="other">Altro</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_balance" class="form-label">Saldo Disponibile (€)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="edit_balance" name="balance">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_result" class="form-label">Risultato Simulazione *</label>
                            <select class="form-control" id="edit_result" name="result" required>
                                <option value="success">✅ Successo</option>
                                <option value="declined">❌ Rifiutata</option>
                                <option value="error">⚠️ Errore</option>
                                <option value="insufficient_funds">💳 Fondi Insufficienti</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_message" class="form-label">Messaggio</label>
                            <input type="text" class="form-control" id="edit_message" name="message">
                        </div>
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