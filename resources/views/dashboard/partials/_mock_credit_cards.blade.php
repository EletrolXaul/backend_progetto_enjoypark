<div class="table-container">
    <h3 class="table-title">
        Carte di Credito
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addMockCreditCardModal">
            <i class="fas fa-plus"></i> Aggiungi Carta
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 200px;">Utente Proprietario</th>
                    <th style="width: 150px;">Numero Carta</th>
                    <th style="width: 150px;">Titolare Carta</th>
                    <th style="width: 100px;">Scadenza</th>
                    <th style="width: 100px;">Saldo</th>
                    <th style="width: 120px;">Risultato Test</th>
                    <th style="width: 100px;">Stato</th>
                    <th style="width: 100px;">Creato il</th>
                    <th style="width: 120px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mockCreditCards as $card)
                <tr>
                    <td><span class="badge bg-secondary">#{{ $card->id }}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle text-muted me-2"></i>
                            <div>
                                <div class="fw-bold">{{ $card->user?->name ?? 'Utente sconosciuto' }}</div>
                                @if($card->user)
                                    <small class="text-muted">{{ $card->user->email }}</small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @php
                                $cardType = '';
                                $cardIcon = 'fas fa-credit-card';
                                $firstDigit = substr($card->card_number, 0, 1);
                                if ($firstDigit == '4') {
                                    $cardType = 'Visa';
                                    $cardIcon = 'fab fa-cc-visa text-primary';
                                } elseif (in_array(substr($card->card_number, 0, 2), ['51', '52', '53', '54', '55'])) {
                                    $cardType = 'Mastercard';
                                    $cardIcon = 'fab fa-cc-mastercard text-warning';
                                } elseif (in_array(substr($card->card_number, 0, 2), ['34', '37'])) {
                                    $cardType = 'Amex';
                                    $cardIcon = 'fab fa-cc-amex text-success';
                                }
                            @endphp
                            <i class="{{ $cardIcon }} me-2"></i>
                            <div>
                                <code>{{ substr($card->card_number, 0, 4) }}...{{ substr($card->card_number, -4) }}</code>
                                <br>
                                <small class="badge bg-light text-dark">{{ $cardType ?: 'Altro' }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <span class="fw-bold">{{ $card->cardholder_name }}</span>
                            <br>
                            <small class="text-muted">CVV: ***</small>
                        </div>
                    </td>
                    <td>
                        @php
                            $expiryDate = \Carbon\Carbon::createFromFormat('m/y', $card->expiry);
                            $isExpired = $expiryDate->isPast();
                        @endphp
                        <span class="badge {{ $isExpired ? 'bg-danger' : 'bg-success' }}">
                            {{ $card->expiry }}
                        </span>
                    </td>
                    <td>
                        @if($card->balance !== null)
                            <span class="fw-bold text-success">€{{ number_format($card->balance, 2) }}</span>
                        @else
                            <small class="text-muted">Non specificato</small>
                        @endif
                    </td>
                    <td>
                        @php
                            $resultConfig = [
                                'success' => ['class' => 'bg-success', 'icon' => 'fas fa-check', 'text' => 'Successo'],
                                'declined' => ['class' => 'bg-danger', 'icon' => 'fas fa-times', 'text' => 'Rifiutata'],
                                'error' => ['class' => 'bg-warning', 'icon' => 'fas fa-exclamation-triangle', 'text' => 'Errore'],
                                'insufficient_funds' => ['class' => 'bg-info', 'icon' => 'fas fa-credit-card', 'text' => 'Fondi Insufficienti']
                            ];
                            $result = $resultConfig[$card->result ?? 'success'] ?? $resultConfig['success'];
                        @endphp
                        <div>
                            <span class="badge {{ $result['class'] }}">
                                <i class="{{ $result['icon'] }} me-1"></i>
                                {{ $result['text'] }}
                            </span>
                            @if($card->message)
                                <br>
                                <small class="text-muted">{{ $card->message }}</small>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($isExpired)
                            <span class="badge bg-danger">Scaduta</span>
                        @else
                            <span class="badge bg-success">Valida</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $card->created_at->format('d/m/Y H:i') }}</small></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-info view-credit-card-details" 
                                    data-id="{{ $card->id }}"
                                    data-user-id="{{ $card->user_id }}"
                                    data-user-name="{{ $card->user?->name ?? 'Utente sconosciuto' }}"
                                    data-user-email="{{ $card->user?->email ?? 'N/A' }}"
                                    data-card-number="{{ $card->card_number }}"
                                    data-cardholder-name="{{ $card->cardholder_name }}"
                                    data-expiry-date="{{ $card->expiry }}"
                                    data-cvv="{{ $card->cvv }}"
                                    data-card-type="{{ $card->card_type ?? 'visa' }}"
                                    data-balance="{{ $card->balance ?? '0' }}"
                                    data-result="{{ $card->result ?? 'success' }}"
                                    data-message="{{ $card->message ?? '' }}"
                                    data-created-at="{{ $card->created_at->format('d/m/Y H:i:s') }}"
                                    title="Visualizza Dettagli Completi">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary edit-mock-credit-card" 
                                    data-id="{{ $card->id }}"
                                    data-user-id="{{ $card->user_id }}"
                                    data-card-number="{{ $card->card_number }}"
                                    data-cardholder-name="{{ $card->cardholder_name }}"
                                    data-expiry-date="{{ $card->expiry }}"
                                    data-cvv="{{ $card->cvv }}"
                                    data-card-type="{{ $card->card_type ?? 'visa' }}"
                                    data-balance="{{ $card->balance ?? '0' }}"
                                    data-result="{{ $card->result ?? 'success' }}"
                                    data-message="{{ $card->message ?? '' }}"
                                    title="Modifica">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-mock-credit-card" 
                                    data-id="{{ $card->id }}"
                                    title="Elimina">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $mockCreditCards->links() }}
    </div>
</div>