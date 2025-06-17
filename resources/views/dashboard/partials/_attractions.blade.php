<div class="table-container">
    <h3 class="table-title">
        Attrazioni
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrizione</th>
                    <th>Capacità</th>
                    <th>Durata</th>
                    <th>Altezza Min</th>
                    <th>Tempo Attesa</th>
                    <th>Stato</th>
                    <th>Livello Brivido</th>
                    <th>Rating</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attractions as $attraction)
                    <tr>
                        <td>{{ $attraction->id }}</td>
                        <td>{{ $attraction->name }}</td>
                        <td>{{ $attraction->category }}</td>
                        <td>{{ Str::limit($attraction->description, 30) }}</td>
                        <td>{{ $attraction->capacity }}</td>
                        <td>{{ $attraction->duration }}</td>
                        <td>{{ $attraction->min_height }} cm</td>
                        <td>{{ $attraction->wait_time }} min</td>
                        <td>
                            @if ($attraction->status == 'open')
                                <span class="badge bg-success">Aperto</span>
                            @elseif($attraction->status == 'closed')
                                <span class="badge bg-danger">Chiuso</span>
                            @else
                                <span class="badge bg-warning">Manutenzione</span>
                            @endif
                        </td>
                        <td>{{ $attraction->thrill_level }}/5</td>
                        <td>{{ number_format($attraction->rating, 1) }}/5</td>
                        <td>{{ $attraction->created_at ? $attraction->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="showAttractionDetails(this)"
                                data-id="{{ $attraction->id }}" data-name="{{ $attraction->name }}"
                                data-category="{{ $attraction->category }}"
                                data-description="{{ $attraction->description }}"
                                data-capacity="{{ $attraction->capacity }}"
                                data-duration="{{ $attraction->duration }}"
                                data-min-height="{{ $attraction->min_height }}"
                                data-wait-time="{{ $attraction->wait_time }}" data-status="{{ $attraction->status }}"
                                data-thrill-level="{{ $attraction->thrill_level }}"
                                data-rating="{{ $attraction->rating }}">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $attractions->links() }}
    </div>
</div>
