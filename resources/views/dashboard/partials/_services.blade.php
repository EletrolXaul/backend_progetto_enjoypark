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
<<<<<<< HEAD
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category }}</td>
                        <td>{{ Str::limit($service->description, 30) }}</td>
                        <td>
                            @if (str_starts_with($service->icon, 'fa'))
                                <i class="{{ $service->icon }}"></i>
                            @else
                                {{ $service->icon }}
                            @endif
                        </td>
                        <td>
                            @if ($service->available_24h)
                                <span class="badge bg-success">24h</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>({{ $service->location_x }}, {{ $service->location_y }})</td>
                        <td>
                            @if (is_array($service->features))
                                {{ implode(', ', $service->features) }}
                            @else
                                {{ $service->features }}
                            @endif
                        </td>
                        <td>{{ $service->created_at ? $service->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <!-- Pulsanti azioni -->
                            <button class="btn btn-sm btn-warning edit-service" data-id="{{ $service->id }}"
                                data-slug="{{ $service->slug }}" data-name="{{ $service->name }}"
                                data-category="{{ $service->category }}"
                                data-description="{{ $service->description }}" data-icon="{{ $service->icon }}"
                                data-available-24h="{{ $service->available_24h }}"
                                data-location-x="{{ $service->location_x }}"
                                data-location-y="{{ $service->location_y }}"
                                data-features="{{ is_array($service->features) ? json_encode($service->features) : $service->features }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-service" data-id="{{ $service->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
=======
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
                        <!-- Pulsanti azioni -->
                        <button class="btn btn-sm btn-primary edit-service" 
                        data-id="{{ $service->id }}" 
                        data-name="{{ $service->name }}" 
                        data-category="{{ $service->category }}"  
                        data-description="{{ $service->description }}" 
                        data-icon="{{ $service->icon }}" 
                        data-available-24h="{{ $service->available_24h }}" 
                        data-location-x="{{ $service->location_x }}"  
                        data-location-y="{{ $service->location_y }}"  
                        data-features='{{ is_array($service->features) ? json_encode($service->features) : $service->features }}'>  
                            <i class="fas fa-edit"></i>  
                        </button>
                        <button class="btn btn-sm btn-danger delete-service" data-id="{{ $service->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
>>>>>>> parent of a82aab4 (correzioni di tutti i controller e delle  tabelle)
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $services->links() }}
    </div>
</div>
