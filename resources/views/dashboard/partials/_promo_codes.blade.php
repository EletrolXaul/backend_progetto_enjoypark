<div class="table-container">
    <h3 class="table-title">
        Codici Promo
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Codice</th>
                    <th>Descrizione</th>
                    <th>Sconto</th>
                    <th>Tipo</th>
                    <th>Valido Fino</th>
                    <th>Utilizzi</th>
                    <th>Stato</th>
                    <th>Creato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promoCodes as $promoCode)
                    <tr>
                        <td><strong class="text-primary">#{{ $promoCode->id }}</strong></td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong class="text-dark">{{ $promoCode->code }}</strong>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-dark">{{ Str::limit($promoCode->description, 50) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong
                                    class="text-success">{{ $promoCode->discount }}{{ $promoCode->type === 'percentage' ? '%' : '€' }}</strong>
                                @if ($promoCode->max_discount)
                                    <small class="text-muted">Max: {{ $promoCode->max_discount }}€</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $promoCode->type === 'percentage' ? 'info' : 'warning' }}">
                                {{ $promoCode->type === 'percentage' ? 'Percentuale' : 'Fisso' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong
                                    class="text-dark">{{ \Carbon\Carbon::parse($promoCode->valid_until)->format('d/m/Y') }}</strong>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($promoCode->valid_until)->format('H:i') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-dark">{{ $promoCode->used_count ?? 0 }}</span>
                                @if ($promoCode->usage_limit > 0)
                                    <small class="text-muted">/ {{ $promoCode->usage_limit }}</small>
                                @else
                                    <small class="text-muted">/ Illimitato</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if ($promoCode->is_active)
                                <span class="badge bg-success">Attivo</span>
                            @else
                                <span class="badge bg-danger">Disattivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong class="text-dark">{{ $promoCode->created_at->format('d/m/Y') }}</strong>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="showPromoCodeDetails(this)"
                                data-id="{{ $promoCode->id }}" data-code="{{ $promoCode->code }}"
                                data-description="{{ $promoCode->description }}"
                                data-discount="{{ $promoCode->discount }}" data-type="{{ $promoCode->type }}"
                                data-valid-until="{{ $promoCode->valid_until ? $promoCode->valid_until->format('d/m/Y') : 'Illimitato' }}"
                                data-max-uses="{{ $promoCode->max_uses }}"
                                data-current-uses="{{ $promoCode->current_uses }}"
                                data-active="{{ $promoCode->is_active ? 'Sì' : 'No' }}">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
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
