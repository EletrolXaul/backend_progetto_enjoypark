<div class="table-container">
    <h3 class="table-title">
        Ristoranti
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Cucina</th>
                    <th>Fascia Prezzo</th>
                    <th>Rating</th>
                    <th>Descrizione</th>
                    <th>Orario Apertura</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->category }}</td>
                        <td>{{ $restaurant->cuisine }}</td>
                        <td>{{ $restaurant->price_range }}</td>
                        <td>{{ number_format($restaurant->rating, 1) }}/5</td>
                        <td>{{ Str::limit($restaurant->description, 30) }}</td>
                        <td>{{ $restaurant->opening_hours }}</td>
                        <td>{{ $restaurant->created_at ? $restaurant->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info view-restaurant"
                                data-name="{{ $restaurant->name }}"
                                data-category="{{ $restaurant->category }}"
                                data-cuisine="{{ $restaurant->cuisine }}"
                                data-price-range="{{ $restaurant->price_range }}"
                                data-rating="{{ number_format($restaurant->rating, 1) }}"
                                data-opening-hours="{{ $restaurant->opening_hours }}"
                                data-location-x="{{ $restaurant->location_x }}"
                                data-location-y="{{ $restaurant->location_y }}"
                                data-description="{{ $restaurant->description }}"
                                data-features='{{ json_encode($restaurant->features) }}'
                                data-image="{{ $restaurant->image }}">
                                <i class="fas fa-eye"></i> Dettagli
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $restaurants->links() }}
    </div>
</div>
