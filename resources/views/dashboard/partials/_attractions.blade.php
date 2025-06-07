<div class="table-container">
    <h3 class="table-title">
        Attrazioni
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addAttractionModal">
            <i class="fas fa-plus"></i> Aggiungi Attrazione
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Capacità</th>
                    <th>Durata</th>
                    <th>Altezza Min</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attractions as $attraction)
                <tr>
                    <td>{{ $attraction->id }}</td>
                    <td>{{ $attraction->name }}</td>
                    <td>{{ Str::limit($attraction->description, 30) }}</td>
                    <td>{{ $attraction->capacity }}</td>
                    <td>{{ $attraction->duration }}</td>
                    <td>{{ $attraction->min_height }} cm</td>
                    <td>{{ $attraction->created_at ? $attraction->created_at->format('d/m/Y') : '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-attraction" data-id="{{ $attraction->id }}" data-name="{{ $attraction->name }}" data-description="{{ $attraction->description }}" data-capacity="{{ $attraction->capacity }}" data-duration="{{ $attraction->duration }}" data-min-height="{{ $attraction->min_height }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-attraction" data-id="{{ $attraction->id }}">
                            <i class="fas fa-trash"></i>
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