<div class="table-container">
    <h3 class="table-title">
        Biglietti
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addTicketModal">
            <i class="fas fa-plus"></i> Aggiungi Biglietto
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Codice</th>
                    <th>Tipo</th>
                    <th>Prezzo</th>
                    <th>Validità</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->code }}</td>
                    <td>{{ $ticket->type }}</td>
                    <td>€{{ $ticket->price }}</td>
                    <td>{{ $ticket->validity_date }}</td>
                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-ticket" data-id="{{ $ticket->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-ticket" data-id="{{ $ticket->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $tickets->links() }}
    </div>
</div>