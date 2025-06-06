<div class="table-container">
    <h3 class="table-title">
        Utenti
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus"></i> Aggiungi Utente
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Membership</th>
                    <th>Admin</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->membership }}</td>
                    <td>{{ $user->is_admin ? 'Sì' : 'No' }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="action-buttons">
                        <button class="btn btn-sm btn-primary edit-user" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>