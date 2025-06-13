<div class="table-container">
    <h3 class="table-title">
        Codici Promo
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addPromoCodeModal">
            <i class="fas fa-plus"></i> Aggiungi Codice Promo
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Codice</th>
                    <th>Descrizione</th>
                    <th>Sconto</th>
                    <th>Validità</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promoCodes as $promoCode)
                <tr>
                    <td>{{ $promoCode->id }}</td>
                    <td>{{ $promoCode->code }}</td>
                    <td>{{ Str::limit($promoCode->description, 30) }}</td>
                    <td>{{ $promoCode->discount }}%</td>
                    <td>{{ $promoCode->valid_until }}</td>
                    <td>{{ $promoCode->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-promo-code" data-id="{{ $promoCode->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-promo-code" data-id="{{ $promoCode->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $promoCodes->links() }}
    </div>
</div>