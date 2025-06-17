<div class="table-container">
    <h3 class="table-title">
        Utenti
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><span class="badge bg-secondary">#{{ $user->id }}</span></td>
                        <td class="text-truncate">{{ $user->name }}</td>
                        <td class="text-truncate">{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-success">Sì</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small></td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-info view-user" data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                data-admin="{{ $user->is_admin ? 'Sì' : 'No' }}"
                                data-created="{{ $user->created_at->format('d/m/Y H:i') }}" data-bs-toggle="modal"
                                data-bs-target="#viewUserModal">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $users->links() }}
    </div>
</div>
{{ $users->links() }}
</div>
