<div class="tab-content-section">
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
                    <th style="width: 150px;">Utente</th>
                    <th style="width: 150px;">Numero Carta</th>
                    <th style="width: 150px;">Titolare</th>
                    <th style="width: 100px;">Scadenza</th>
                    <th style="width: 80px;">Tipo</th>
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
                            <span>{{ $card->user?->name ?? 'Utente sconosciuto' }}</span>
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
                            <code>{{ substr($card->card_number, 0, 4) }}...{{ substr($card->card_number, -4) }}</code>
                        </div>
                    </td>
                    <td>
                        <span class="fw-bold">{{ $card->cardholder_name }}</span>
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
                        @if($cardType)
                            <small class="badge bg-light text-dark">{{ $cardType }}</small>
                        @else
                            <small class="text-muted">Altro</small>
                        @endif
                    </td>
                    <td>
                        @php
                            $expiryDate = \Carbon\Carbon::createFromFormat('m/y', $card->expiry);
                            $isExpired = $expiryDate->isPast();
                        @endphp
                        @if($isExpired)
                            <span class="badge bg-danger">Scaduta</span>
                        @else
                            <span class="badge bg-success">Valida</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $card->created_at->format('d/m/Y') }}</small></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-primary edit-mock-credit-card" 
                                    data-id="{{ $card->id }}"
                                    data-user-id="{{ $card->user_id }}"
                                    data-card-number="{{ $card->card_number }}"
                                    data-cardholder-name="{{ $card->cardholder_name }}"
                                    data-expiry-date="{{ $card->expiry }}"
                                    data-cvv="{{ $card->cvv }}"
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