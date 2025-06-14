<div class="table-container">
    <h3 class="table-title">
        Negozi
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
                        <button type="button" class="btn btn-sm btn-info view-shop"
                            data-name="{{ $shop->name }}"
                            data-category="{{ $shop->category }}"
                            data-opening-hours="{{ $shop->opening_hours }}"
                            data-location-x="{{ $shop->location_x }}"
                            data-location-y="{{ $shop->location_y }}"
                            data-description="{{ $shop->description }}"
                            data-specialties='{{ json_encode($shop->specialties) }}'>
                            <i class="fas fa-eye"></i> Dettagli
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