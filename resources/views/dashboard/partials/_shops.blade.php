<div class="table-container">
    <h3 class="table-title">
        Negozi
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addShopModal">
            <i class="fas fa-plus"></i> Aggiungi Negozio
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
                    <th>Orario Apertura</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->name }}</td>
                    <td>{{ Str::limit($shop->description, 30) }}</td>
                    <td>{{ $shop->type }}</td>
                    <td>{{ $shop->opening_hours }}</td>
                    <td>{{ $shop->created_at ? $shop->created_at->format('d/m/Y') : '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-shop" data-id="{{ $shop->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-shop" data-id="{{ $shop->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $shops->links() }}
    </div>
</div>