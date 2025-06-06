<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard EnjoyPark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-title {
            margin-bottom: 30px;
            color: #2c3e50;
            text-align: center;
        }

        .table-container {
            margin-bottom: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table-title {
            background-color: #3498db;
            color: white;
            padding: 15px;
            margin: 0;
            font-size: 1.2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .tab-content {
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h1 class="dashboard-title">Dashboard EnjoyPark - Database</h1>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach (['users', 'orders', 'tickets', 'attractions', 'shows', 'restaurants', 'shops', 'services', 'locations', 'promoCodes', 'visitHistories', 'mockCreditCards'] as $index => $table)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="{{ $table }}-tab"
                        data-bs-toggle="tab" data-bs-target="#{{ $table }}" type="button" role="tab"
                        aria-controls="{{ $table }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                        {{ ucfirst($table) }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Users Table -->
            <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                <div class="table-container">
                    <h3 class="table-title">Utenti</h3>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <div class="table-container">
                    <h3 class="table-title">Ordini</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Numero Ordine</th>
                                    <th>Utente ID</th>
                                    <th>Prezzo Totale</th>
                                    <th>Data Acquisto</th>
                                    <th>Data Visita</th>
                                    <th>Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>€{{ $order->total_price }}</td>
                                        <td>{{ $order->purchase_date }}</td>
                                        <td>{{ $order->visit_date }}</td>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="tab-pane fade" id="tickets" role="tabpanel" aria-labelledby="tickets-tab">
                <div class="table-container">
                    <h3 class="table-title">Biglietti</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Utente ID</th>
                                    <th>Numero Ordine</th>
                                    <th>Tipo Biglietto</th>
                                    <th>Prezzo</th>
                                    <th>Data Visita</th>
                                    <th>Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->user_id }}</td>
                                        <td>{{ $ticket->order_number }}</td>
                                        <td>{{ $ticket->ticket_type }}</td>
                                        <td>€{{ $ticket->price }}</td>
                                        <td>{{ $ticket->visit_date }}</td>
                                        <td>{{ $ticket->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Attractions Table -->
            <div class="tab-pane fade" id="attractions" role="tabpanel" aria-labelledby="attractions-tab">
                <div class="table-container">
                    <h3 class="table-title">Attrazioni</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Tempo di Attesa</th>
                                    <th>Stato</th>
                                    <th>Livello Brivido</th>
                                    <th>Altezza Minima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attractions as $attraction)
                                    <tr>
                                        <td>{{ $attraction->id }}</td>
                                        <td>{{ $attraction->name }}</td>
                                        <td>{{ $attraction->category }}</td>
                                        <td>{{ $attraction->wait_time }} min</td>
                                        <td>{{ $attraction->status }}</td>
                                        <td>{{ $attraction->thrill_level }}/5</td>
                                        <td>{{ $attraction->min_height }} cm</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Shows Table -->
            <div class="tab-pane fade" id="shows" role="tabpanel" aria-labelledby="shows-tab">
                <div class="table-container">
                    <h3 class="table-title">Spettacoli</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Luogo</th>
                                    <th>Durata</th>
                                    <th>Categoria</th>
                                    <th>Capacità</th>
                                    <th>Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shows as $show)
                                    <tr>
                                        <td>{{ $show->id }}</td>
                                        <td>{{ $show->name }}</td>
                                        <td>{{ $show->venue }}</td>
                                        <td>{{ $show->duration }}</td>
                                        <td>{{ $show->category }}</td>
                                        <td>{{ $show->capacity }}</td>
                                        <td>€{{ $show->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Restaurants Table -->
            <div class="tab-pane fade" id="restaurants" role="tabpanel" aria-labelledby="restaurants-tab">
                <div class="table-container">
                    <h3 class="table-title">Ristoranti</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Cucina</th>
                                    <th>Fascia di Prezzo</th>
                                    <th>Valutazione</th>
                                    <th>Orari di Apertura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurants as $restaurant)
                                    <tr>
                                        <td>{{ $restaurant->id }}</td>
                                        <td>{{ $restaurant->name }}</td>
                                        <td>{{ $restaurant->category }}</td>
                                        <td>{{ $restaurant->cuisine }}</td>
                                        <td>{{ $restaurant->price_range }}</td>
                                        <td>{{ $restaurant->rating }}/5</td>
                                        <td>{{ $restaurant->opening_hours }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Shops Table -->
            <div class="tab-pane fade" id="shops" role="tabpanel" aria-labelledby="shops-tab">
                <div class="table-container">
                    <h3 class="table-title">Negozi</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Descrizione</th>
                                    <th>Specialità</th>
                                    <th>Orari di Apertura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->category }}</td>
                                        <td>{{ $shop->description }}</td>
                                        <td>{{ is_array($shop->specialties) ? implode(', ', $shop->specialties) : $shop->specialties }}
                                        </td>
                                        <td>{{ $shop->opening_hours }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Services Table -->
            <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                <div class="table-container">
                    <h3 class="table-title">Servizi</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Descrizione</th>
                                    <th>Disponibile 24h</th>
                                    <th>Caratteristiche</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->category }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>{{ $service->available24h ? 'Sì' : 'No' }}</td>
                                        <td>{{ is_array($service->features) ? implode(', ', $service->features) : $service->features }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Locations Table -->
            <div class="tab-pane fade" id="locations" role="tabpanel" aria-labelledby="locations-tab">
                <div class="table-container">
                    <h3 class="table-title">Posizioni</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Descrizione</th>
                                    <th>Latitudine</th>
                                    <th>Longitudine</th>
                                    <th>Visibile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{ $location->id }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->category }}</td>
                                        <td>{{ $location->description }}</td>
                                        <td>{{ $location->latitude }}</td>
                                        <td>{{ $location->longitude }}</td>
                                        <td>{{ $location->is_visible ? 'Sì' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Promo Codes Table -->
            <div class="tab-pane fade" id="promoCodes" role="tabpanel" aria-labelledby="promoCodes-tab">
                <div class="table-container">
                    <h3 class="table-title">Codici Promozionali</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Codice</th>
                                    <th>Sconto</th>
                                    <th>Tipo</th>
                                    <th>Descrizione</th>
                                    <th>Importo Minimo</th>
                                    <th>Sconto Massimo</th>
                                    <th>Valido Fino</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promoCodes as $promoCode)
                                    <tr>
                                        <td>{{ $promoCode->id }}</td>
                                        <td>{{ $promoCode->code }}</td>
                                        <td>{{ $promoCode->discount }}</td>
                                        <td>{{ $promoCode->type }}</td>
                                        <td>{{ $promoCode->description }}</td>
                                        <td>{{ $promoCode->min_amount }}</td>
                                        <td>{{ $promoCode->max_discount }}</td>
                                        <td>{{ $promoCode->valid_until }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Visit Histories Table -->
            <div class="tab-pane fade" id="visitHistories" role="tabpanel" aria-labelledby="visitHistories-tab">
                <div class="table-container">
                    <h3 class="table-title">Cronologia Visite</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Utente ID</th>
                                    <th>Data Visita</th>
                                    <th>Attrazioni</th>
                                    <th>Valutazione</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitHistories as $history)
                                    <tr>
                                        <td>{{ $history->id }}</td>
                                        <td>{{ $history->user_id }}</td>
                                        <td>{{ $history->visit_date }}</td>
                                        <td>{{ is_array($history->attractions) ? implode(', ', $history->attractions) : $history->attractions }}
                                        </td>
                                        <td>{{ $history->rating }}/5</td>
                                        <td>{{ $history->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mock Credit Cards Table -->
            <div class="tab-pane fade" id="mockCreditCards" role="tabpanel" aria-labelledby="mockCreditCards-tab">
                <div class="table-container">
                    <h3 class="table-title">Carte di Credito Mock</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Numero Carta</th>
                                    <th>Titolare</th>
                                    <th>Data Scadenza</th>
                                    <th>CVV</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mockCreditCards as $card)
                                    <tr>
                                        <td>{{ $card->id }}</td>
                                        <td>{{ substr($card->card_number, 0, 4) . ' **** **** ' . substr($card->card_number, -4) }}
                                        </td>
                                        <td>{{ $card->cardholder_name }}</td>
                                        <td>{{ $card->expiration_date }}</td>
                                        <td>***</td>
                                        <td>{{ $card->card_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
