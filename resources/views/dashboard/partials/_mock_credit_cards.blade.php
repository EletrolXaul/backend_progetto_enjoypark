<div class="table-container">
    <h3 class="table-title">
        Carte di Credito
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addMockCreditCardModal">
            <i class="fas fa-plus"></i> Aggiungi Carta
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utente</th>
                    <th>Numero Carta</th>
                    <th>Titolare</th>
                    <th>Scadenza</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mockCreditCards as $card)
                <tr>
                    <td>{{ $card->id }}</td>
                    <td>{{ $card->user->name }}</td>
                    <td>{{ substr($card->card_number, 0, 4) }}...{{ substr($card->card_number, -4) }}</td>
                    <td>{{ $card->cardholder_name }}</td>
                    <td>{{ $card->expiry_date }}</td>
                    <td>{{ $card->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-mock-credit-card" data-id="{{ $card->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-mock-credit-card" data-id="{{ $card->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
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