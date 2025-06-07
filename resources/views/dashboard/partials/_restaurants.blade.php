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
                    <th>Descrizione</th>
                    <th>Tipo Cucina</th>
                    <th>Capacità</th>
                    <th>Orario Apertura</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->id ?? $loop->iteration }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ Str::limit($restaurant->description, 30) }}</td>
                        <td>{{ $restaurant->cuisine ?? $restaurant->cuisine_type }}</td>
                        <td>{{ $restaurant->capacity ?? '-' }}</td>
                        <td>{{ $restaurant->opening_hours }}</td>
                        <td>{{ $restaurant->created_at ? $restaurant->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-restaurant" data-id="{{ $restaurant->id }}">
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
