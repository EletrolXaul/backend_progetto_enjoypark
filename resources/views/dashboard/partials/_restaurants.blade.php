<div class="table-container">
    <h3 class="table-title">
        Ristoranti
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addRestaurantModal">
            <i class="fas fa-plus"></i> Aggiungi Ristorante
        </button>
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
                            <!-- Pulsanti azioni -->
                            <button class="btn btn-sm btn-primary edit-restaurant" 
                            data-id="{{ $restaurant->id }}" 
                            data-name="{{ $restaurant->name }}" 
                            data-category="{{ $restaurant->category }}"  
                            data-cuisine="{{ $restaurant->cuisine }}" 
                            data-price-range="{{ $restaurant->price_range }}" 
                            data-rating="{{ $restaurant->rating }}" 
                            data-description="{{ $restaurant->description }}"  
                            data-opening-hours="{{ $restaurant->opening_hours }}">  
                                <i class="fas fa-edit"></i>  
                            </button>
                            <button class="btn btn-sm btn-danger delete-restaurant" data-id="{{ $restaurant->id }}">
                                <i class="fas fa-trash"></i>
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
