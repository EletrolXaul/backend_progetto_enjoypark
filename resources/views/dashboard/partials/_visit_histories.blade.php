<div class="tab-content-section">
    <h3 class="table-title">
        Cronologia Visite
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover visit-histories-table">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Utente</th>
                    <th>Data Visita</th>
                    <th>Durata</th>
                    <th>Attrazioni</th>
                    <th>Stato</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitHistories as $visitHistory)
                    <tr>
                        <td><span class="badge bg-secondary">#{{ $visitHistory->id }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle text-muted me-2"></i>
                                <span class="text-truncate">{{ $visitHistory->user->name ?? 'Utente sconosciuto' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">
                                {{ \Carbon\Carbon::parse($visitHistory->visit_date)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ $visitHistory->duration ?? 'N/A' }}h
                            </span>
                        </td>
                        <td class="attractions-cell">
                            @if (is_array($visitHistory->attractions))
                                @foreach (array_slice($visitHistory->attractions, 0, 3) as $attraction)
                                    <small class="badge bg-light text-dark">{{ $attraction }}</small>
                                @endforeach
                                @if (count($visitHistory->attractions) > 3)
                                    <small class="badge bg-secondary">+{{ count($visitHistory->attractions) - 3 }}</small>
                                @endif
                            @else
                                <small class="text-muted">{{ $visitHistory->attractions_visited ?? 'Nessuna' }}</small>
                            @endif
                        </td>
                        <td>
                            @if (\Carbon\Carbon::parse($visitHistory->visit_date)->isPast())
                                <span class="badge bg-success">Completata</span>
                            @else
                                <span class="badge bg-primary">Programmata</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $visitHistory->created_at->format('d/m/Y') }}</small></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="showVisitDetails(this)"
                                data-id="{{ $visitHistory->id }}"
                                data-user="{{ $visitHistory->user->name ?? 'Utente sconosciuto' }}"
                                data-visit-date="{{ \Carbon\Carbon::parse($visitHistory->visit_date)->format('d/m/Y') }}"
                                data-duration="{{ $visitHistory->duration }}"
                                data-attractions="{{ is_array($visitHistory->attractions) ? implode(', ', $visitHistory->attractions) : $visitHistory->attractions_visited }}">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
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
