<div class="table-container">
    <h3 class="table-title">
        Spettacoli
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addShowModal">
            <i class="fas fa-plus"></i> Aggiungi Spettacolo
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Orario</th>
                    <th>Durata</th>
                    <th>Luogo</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shows as $show)
                <tr>
                    <td>{{ $show->id }}</td>
                    <td>{{ $show->name }}</td>
                    <td>{{ Str::limit($show->description, 30) }}</td>
                    <td>{{ $show->time }}</td>
                    <td>{{ $show->duration }} min</td>
                    <td>{{ $show->location }}</td>
                    <td>{{ $show->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-show" data-id="{{ $show->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-show" data-id="{{ $show->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $shows->links() }}
    </div>
</div>