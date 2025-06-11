<div class="tab-content-section">
    <h3 class="table-title">
        Cronologia Visite
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addVisitHistoryModal">
            <i class="fas fa-plus"></i> Aggiungi Visita
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 150px;">Utente</th>
                    <th style="width: 120px;">Data Visita</th>
                    <th style="width: 80px;">Durata</th>
                    <th style="width: 200px;">Attrazioni</th>
                    <th style="width: 100px;">Stato</th>
                    <th style="width: 100px;">Creato il</th>
                    <th style="width: 120px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitHistories as $visitHistory)
                <tr>
                    <td><span class="badge bg-secondary">#{{ $visitHistory->id }}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle text-muted me-2"></i>
                            <span>{{ $visitHistory->user->name ?? 'Utente sconosciuto' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-info">
                            {{ \Carbon\Carbon::parse($visitHistory->visit_date)->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            {{ $visitHistory->duration ?? 'N/A' }} ore
                        </span>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 180px;">
                            @if(is_array($visitHistory->attractions))
                                @foreach($visitHistory->attractions as $attraction)
                                    <small class="badge bg-light text-dark me-1">{{ $attraction }}</small>
                                @endforeach
                            @else
                                <small class="text-muted">{{ $visitHistory->attractions_visited ?? 'Nessuna attrazione' }}</small>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if(\Carbon\Carbon::parse($visitHistory->visit_date)->isPast())
                            <span class="badge bg-success">Completata</span>
                        @else
                            <span class="badge bg-primary">Programmata</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $visitHistory->created_at->format('d/m/Y') }}</small></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-primary edit-visit-history" 
                                    data-id="{{ $visitHistory->id }}"
                                    data-user-id="{{ $visitHistory->user_id }}"
                                    data-visit-date="{{ $visitHistory->visit_date }}"
                                    data-duration="{{ $visitHistory->duration }}"
                                    data-attractions="{{ json_encode($visitHistory->attractions) }}"
                                    title="Modifica">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-visit-history" 
                                    data-id="{{ $visitHistory->id }}"
                                    title="Elimina">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $visitHistories->links() }}
    </div>
</div>