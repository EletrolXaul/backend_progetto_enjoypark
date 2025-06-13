<div class="table-section">
    <h3 class="table-title">
        Tipi di Biglietti
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Prezzo</th>
                    <th>Descrizione</th>
                    <th>Caratteristiche</th>
                    <th>Stato</th>
                    <th>Creato il</th>
                    <th>Dettagli</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketTypes as $ticketType)
                <tr>
                    <td>{{ $ticketType->id }}</td>
                    <td>{{ $ticketType->name }}</td>
                    <td>
                        <span class="badge bg-{{ $ticketType->type === 'standard' ? 'secondary' : ($ticketType->type === 'premium' ? 'warning' : 'success') }}">
                            {{ ucfirst($ticketType->type) }}
                        </span>
                    </td>
                    <td>€{{ number_format($ticketType->price, 2) }}</td>
                    <td>
                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $ticketType->description }}">
                            {{ $ticketType->description }}
                        </span>
                    </td>
                    <td>
                        @if($ticketType->features && is_array($ticketType->features))
                            <div class="features-list">
                                @foreach(array_slice($ticketType->features, 0, 2) as $feature)
                                    <small class="badge bg-light text-dark me-1">{{ $feature }}</small>
                                @endforeach
                                @if(count($ticketType->features) > 2)
                                    <small class="text-muted">+{{ count($ticketType->features) - 2 }} altro/i</small>
                                @endif
                            </div>
                        @else
                            <span class="text-muted">Nessuna</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $ticketType->is_active ? 'success' : 'danger' }}">
                            {{ $ticketType->is_active ? 'Attivo' : 'Inattivo' }}
                        </span>
                    </td>
                    <td>{{ $ticketType->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-info view-ticket-type" data-id="{{ $ticketType->id }}" data-bs-toggle="modal" data-bs-target="#viewTicketTypeModal">
                            <i class="fas fa-eye"></i> Visualizza
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $ticketTypes->links() }}
    </div>
</div>