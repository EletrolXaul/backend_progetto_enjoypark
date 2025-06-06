<div class="table-container">
    <h3 class="table-title">
        Servizi
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fas fa-plus"></i> Aggiungi Servizio
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
                    <th>Disponibilità</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ Str::limit($service->description, 30) }}</td>
                    <td>{{ $service->type }}</td>
                    <td>{{ $service->availability }}</td>
                    <td>{{ $service->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-service" data-id="{{ $service->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-service" data-id="{{ $service->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $services->links() }}
    </div>
</div>