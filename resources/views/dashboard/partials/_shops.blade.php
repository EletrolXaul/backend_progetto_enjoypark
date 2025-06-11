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
                    <th>Categoria</th>
                    <th>Descrizione</th>
                    <th>Specialità</th>
                    <th>Orario Apertura</th>
                    <th>Posizione</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->category }}</td>
                    <td>{{ Str::limit($shop->description, 30) }}</td>
                    <td>
                        @if(is_array($shop->specialties))
                            {{ implode(', ', $shop->specialties) }}
                        @else
                            {{ $shop->specialties }}
                        @endif
                    </td>
                    <td>{{ $shop->opening_hours }}</td>
                    <td>({{ $shop->location_x }}, {{ $shop->location_y }})</td>
                    <td>{{ $shop->created_at ? $shop->created_at->format('d/m/Y') : '-' }}</td>
                    <td>
                        <!-- Pulsanti azioni -->
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