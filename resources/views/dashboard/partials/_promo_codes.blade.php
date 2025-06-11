<div class="table-container">
    <h3 class="table-title">
        Codici Promo
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addPromoCodeModal">
            <i class="fas fa-plus"></i> Aggiungi Codice Promo
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 120px;">Codice</th>
                    <th style="width: 300px;">Descrizione</th>
                    <th style="width: 80px;">Sconto</th>
                    <th style="width: 120px;">Validità</th>
                    <th style="width: 100px;">Stato</th>
                    <th style="width: 100px;">Creato il</th>
                    <th style="width: 120px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promoCodes as $promoCode)
                <tr>
                    <td><span class="badge bg-secondary">#{{ $promoCode->id }}</span></td>
                    <td><code class="text-primary fw-bold">{{ $promoCode->code }}</code></td>
                    <td>
                        <div class="text-wrap" style="max-width: 280px; line-height: 1.4;" title="{{ $promoCode->description }}">
                            <strong>{{ $promoCode->description }}</strong>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-success fs-6">{{ $promoCode->discount }}%</span>
                    </td>
                    <td>
                        <div class="text-center">
                            <strong class="text-dark">{{ \Carbon\Carbon::parse($promoCode->valid_until)->format('d/m/Y') }}</strong>
                            <br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($promoCode->valid_until)->format('H:i') }}</small>
                        </div>
                    </td>
                    <td>
                        @if(\Carbon\Carbon::parse($promoCode->valid_until)->isFuture())
                            <span class="badge bg-success fs-6">✓ Attivo</span>
                        @else
                            <span class="badge bg-danger fs-6">✗ Scaduto</span>
                        @endif
                    </td>
                    <td>
                        <div class="text-center">
                            <strong class="text-dark">{{ $promoCode->created_at->format('d/m/Y') }}</strong>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-primary edit-promo-code"
                                    data-id="{{ $promoCode->id }}"
                                    data-code="{{ $promoCode->code }}"
                                    data-description="{{ $promoCode->description }}"
                                    data-discount="{{ $promoCode->discount }}"
                                    data-type="{{ $promoCode->type ?? 'percentage' }}"
                                    data-valid-until="{{ $promoCode->valid_until }}"
                                    data-min-amount="{{ $promoCode->min_amount ?? '' }}"
                                    data-max-discount="{{ $promoCode->max_discount ?? '' }}"
                                    data-usage-limit="{{ $promoCode->usage_limit ?? 0 }}"
                                    data-used-count="{{ $promoCode->used_count ?? 0 }}"
                                    data-is-active="{{ $promoCode->is_active ?? 1 }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-promo-code" 
                                    data-id="{{ $promoCode->id }}"
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
    <div class="d-flex justify-content-center mt-3">
        {{ $promoCodes->links() }}
    </div>
</div>