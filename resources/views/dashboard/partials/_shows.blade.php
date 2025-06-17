<div class="table-container">
    <h3 class="table-title">
        Spettacoli
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrizione</th>
                    <th>Venue</th>
                    <th>Orario</th>
                    <th>Durata</th>
                    <th>Capacità</th>
                    <th>Posti Disponibili</th>
                    <th>Prezzo</th>
                    <th>Rating</th>
                    <th>Età Min</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shows as $show)
                    <tr>
                        <td>{{ $show->id }}</td>
                        <td>{{ $show->name }}</td>
                        <td>{{ $show->category }}</td>
                        <td>{{ Str::limit($show->description, 30) }}</td>
                        <td>{{ $show->venue }}</td>
                        <td>
                            @if (isset($show->times) && is_array($show->times))
                                {{ implode(', ', $show->times) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $show->duration }}</td>
                        <td>{{ $show->capacity }}</td>
                        <td>{{ $show->available_seats }}</td>
                        <td>€{{ number_format($show->price, 2) }}</td>
                        <td>{{ number_format($show->rating, 1) }}/5</td>
                        <td>{{ $show->age_restriction }}</td>
                        <td>{{ $show->created_at ? $show->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="showShowDetails(this)"
                                data-id="{{ $show->id }}" data-name="{{ $show->name }}"
                                data-category="{{ $show->category }}" data-description="{{ $show->description }}"
                                data-venue="{{ $show->venue }}" data-duration="{{ $show->duration }}"
                                data-capacity="{{ $show->capacity }}"
                                data-available-seats="{{ $show->available_seats }}" data-price="{{ $show->price }}"
                                data-rating="{{ $show->rating }}" data-age-restriction="{{ $show->age_restriction }}">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $shows->links() }}
    </div>
</div>
