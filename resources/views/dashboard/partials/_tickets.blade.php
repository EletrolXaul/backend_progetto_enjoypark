<div class="table-container">
    <h3 class="table-title">
        Biglietti
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
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->code }}</td>
                        <td>{{ $ticket->type }}</td>
                        <td>€{{ $ticket->price }}</td>
                        <td>{{ $ticket->validity_date }}</td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="showTicketDetails(this)"
                                data-id="{{ $ticket->id }}" data-code="{{ $ticket->code }}"
                                data-type="{{ $ticket->type }}" data-price="{{ $ticket->price }}"
                                data-validity="{{ $ticket->validity_date }}"
                                data-created="{{ $ticket->created_at->format('d/m/Y') }}">
                                <i class="fas fa-eye"></i> Visualizza
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
