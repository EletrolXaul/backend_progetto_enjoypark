<div class="table-container">
    <h3 class="table-title">
        Cronologia Visite
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addVisitHistoryModal">
            <i class="fas fa-plus"></i> Aggiungi Visita
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utente</th>
                    <th>Data Visita</th>
                    <th>Durata</th>
                    <th>Attrazioni Visitate</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitHistories as $visitHistory)
                <tr>
                    <td>{{ $visitHistory->id }}</td>
                    <td>{{ $visitHistory->user->name }}</td>
                    <td>{{ $visitHistory->visit_date }}</td>
                    <td>{{ $visitHistory->duration }} ore</td>
                    <td>{{ $visitHistory->attractions_visited }}</td>
                    <td>{{ $visitHistory->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-visit-history" data-id="{{ $visitHistory->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-visit-history" data-id="{{ $visitHistory->id }}">
                            <i class="fas fa-trash"></i>
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