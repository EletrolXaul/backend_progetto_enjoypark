<div class="table-container">
    <h3 class="table-title">
        Posizioni
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addLocationModal">
            <i class="fas fa-plus"></i> Aggiungi Posizione
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Tipo</th>
                    <th>Coordinate</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ Str::limit($location->description, 30) }}</td>
                    <td>{{ $location->type }}</td>
                    <td>{{ $location->coordinates }}</td>
                    <td>{{ $location->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-location" data-id="{{ $location->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-location" data-id="{{ $location->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $locations->links() }}
    </div>
</div>