<div class="table-container">
    <h3 class="table-title">
        Planner Utenti
        <span class="badge bg-info">{{ $stats['totalPlannerItems'] ?? 0 }} totali</span>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utente</th>
                    <th>Data</th>
                    <th>Nome Item</th>
                    <th>Tipo</th>
                    <th>Orario</th>
                    <th>Priorità</th>
                    <th>Completato</th>
                    <th>Note</th>
                    <th>Creato il</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($plannerItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <strong>{{ $item->user->name }}</strong><br>
                        <small class="text-muted">{{ $item->user->email }}</small>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <span class="badge 
                            @switch($item->type)
                                @case('attraction') bg-primary @break
                                @case('show') bg-warning @break
                                @case('restaurant') bg-success @break
                                @case('shop') bg-info @break
                                @case('service') bg-secondary @break
                                @default bg-light
                            @endswitch
                        ">
                            {{ ucfirst($item->type) }}
                        </span>
                    </td>
                    <td>{{ $item->time ?? '-' }}</td>
                    <td>
                        <span class="badge 
                            @switch($item->priority)
                                @case('high') bg-danger @break
                                @case('medium') bg-warning @break
                                @case('low') bg-success @break
                                @default bg-light
                            @endswitch
                        ">
                            {{ ucfirst($item->priority) }}
                        </span>
                    </td>
                    <td>
                        @if($item->completed)
                            <span class="badge bg-success">✓ Completato</span>
                        @else
                            <span class="badge bg-secondary">In attesa</span>
                        @endif
                    </td>
                    <td>
                        @if($item->notes)
                            <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $item->notes }}">
                                {{ $item->notes }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">
                        Nessun item del planner trovato
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $plannerItems->links() }}
</div>