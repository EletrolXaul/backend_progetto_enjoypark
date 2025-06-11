<!-- Add Visit History Modal -->
<div class="modal fade" id="addVisitHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Nuova Visita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVisitHistoryForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Utente *</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Seleziona un utente</option>
                                @foreach($users ?? [] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="visit_date" class="form-label">Data Visita *</label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Durata (ore)</label>
                            <input type="number" step="0.5" min="0" max="24" class="form-control" id="duration" name="duration" placeholder="es. 3.5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Valutazione</label>
                            <select class="form-control" id="rating" name="rating">
                                <option value="">Nessuna valutazione</option>
                                <option value="1">⭐ 1 stella</option>
                                <option value="2">⭐⭐ 2 stelle</option>
                                <option value="3">⭐⭐⭐ 3 stelle</option>
                                <option value="4">⭐⭐⭐⭐ 4 stelle</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5 stelle</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="attractions" class="form-label">Attrazioni Visitate</label>
                        <textarea class="form-control" id="attractions" name="attractions" rows="3" placeholder='["Attrazione 1", "Attrazione 2", "Attrazione 3"]'></textarea>
                        <small class="form-text text-muted">Inserisci un array JSON di nomi delle attrazioni, es: ["Montagne Russe", "Casa Stregata"]</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Note</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Note aggiuntive sulla visita..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveVisitHistoryBtn">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Visit History Modal -->
<div class="modal fade" id="editVisitHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Visita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVisitHistoryForm">
                    <input type="hidden" id="edit_visit_history_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_user_id" class="form-label">Utente *</label>
                            <select class="form-control" id="edit_user_id" name="user_id" required>
                                @foreach($users ?? [] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_visit_date" class="form-label">Data Visita *</label>
                            <input type="date" class="form-control" id="edit_visit_date" name="visit_date" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_duration" class="form-label">Durata (ore)</label>
                            <input type="number" step="0.5" min="0" max="24" class="form-control" id="edit_duration" name="duration">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_rating" class="form-label">Valutazione</label>
                            <select class="form-control" id="edit_rating" name="rating">
                                <option value="">Nessuna valutazione</option>
                                <option value="1">⭐ 1 stella</option>
                                <option value="2">⭐⭐ 2 stelle</option>
                                <option value="3">⭐⭐⭐ 3 stelle</option>
                                <option value="4">⭐⭐⭐⭐ 4 stelle</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5 stelle</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_attractions" class="form-label">Attrazioni Visitate</label>
                        <textarea class="form-control" id="edit_attractions" name="attractions" rows="3"></textarea>
                        <small class="form-text text-muted">Array JSON di nomi delle attrazioni</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label">Note</label>
                        <textarea class="form-control" id="edit_notes" name="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="updateVisitHistoryBtn">Aggiorna</button>
            </div>
        </div>
    </div>
</div>