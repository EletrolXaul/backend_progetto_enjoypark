<div class="table-container">
    <h3 class="table-title">
        Ordini
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
                @foreach ($orders as $order)
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
                            <button class="btn btn-sm btn-info" onclick="showOrderDetails(this)"
                                data-id="{{ $order->id }}" data-number="{{ $order->order_number }}"
                                data-user="{{ $order->user->name }}" data-total="{{ $order->total_price }}"
                                data-status="{{ $order->status }}"
                                data-date="{{ $order->created_at->format('d/m/Y H:i') }}">
                                <i class="fas fa-eye"></i> Visualizza
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="pagination-container">
    {{ $orders->links() }}
</div>
</div>
