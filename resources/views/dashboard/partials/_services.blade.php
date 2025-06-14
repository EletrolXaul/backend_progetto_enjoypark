<div class="table-container">
    <h3 class="table-title">
        Servizi
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrizione</th>
                    <th>Icona</th>
                    <th>24h</th>
                    <th>Posizione</th>
                    <th>Features</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->category }}</td>
                    <td>{{ Str::limit($service->description, 30) }}</td>
                    <td><i class="{{ $service->icon }}"></i></td>
                    <td>
                        @if($service->available_24h)
                            <span class="badge bg-success">24h</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>({{ $service->location_x }}, {{ $service->location_y }})</td>
                    <td>
                        @if(is_array($service->features))
                            {{ implode(', ', $service->features) }}
                        @else
                            {{ $service->features }}
                        @endif
                    </td>
                    <td>{{ $service->created_at ? $service->created_at->format('d/m/Y') : '-' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info view-service"
                            data-name="{{ $service->name }}"
                            data-category="{{ $service->category }}"
                            data-icon="{{ $service->icon }}"
                            data-available-24h="{{ $service->available_24h ? 'true' : 'false' }}"
                            data-location-x="{{ $service->location_x }}"
                            data-location-y="{{ $service->location_y }}"
                            data-description="{{ $service->description }}"
                            data-features='{{ json_encode($service->features) }}'>
                            <i class="fas fa-eye"></i> Dettagli
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