<div class="table-container">
    <h3 class="table-title">
        Ordini
        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addOrderModal">
            <i class="fas fa-plus"></i> Aggiungi Ordine
        </button>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Numero Ordine</th>
                    <th>Utente</th>
                    <th>Prezzo Totale</th>
                    <th>Stato</th>
                    <th>Data</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td data-user-id="{{ $order->user_id }}">{{ $order->user->name }}</td>
                    <td>€{{ $order->total_price }}</td>
                    <td data-status="{{ $order->status }}">
                        @switch($order->status)
                            @case('pending')
                                In attesa
                                @break
                            @case('completed')
                                Completato
                                @break
                            @case('cancelled')
                                Annullato
                                @break
                            @default
                                {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-order" data-id="{{ $order->id }}" data-status="{{ $order->status }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $orders->links() }}
    </div>
</div>