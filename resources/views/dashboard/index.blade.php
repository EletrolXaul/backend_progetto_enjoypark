@extends('layouts._dashboard_layout')

@section('title', 'Dashboard EnjoyPark')

@section('content')
    @include('dashboard.partials._sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="dashboard-title">Dashboard EnjoyPark - Gestione Database</h1>

        <div class="tab-content">
            <!-- Dashboard Overview -->
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                @include('dashboard.partials._stats')

                <div class="row">
                    <div class="col-md-6">
                        <div class="recent-activity">
                            <h3>Ordini Recenti</h3>
                            @foreach ($stats['recentOrders'] as $order)
                                <div class="activity-item">
                                    <p><strong>Ordine #{{ $order->order_number }}</strong> - €{{ $order->total_price }}</p>
                                    <small>{{ $order->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="recent-activity">
                            <h3>Nuovi Utenti</h3>
                            @foreach ($stats['recentUsers'] as $user)
                                <div class="activity-item">
                                    <p><strong>{{ $user->name }}</strong> - {{ $user->email }}</p>
                                    <small>{{ $user->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users" role="tabpanel">
                @include('dashboard.partials._users')
            </div>

            <!-- Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                @include('dashboard.partials._orders')
            </div>

            <!-- Tickets Tab -->
            <div class="tab-pane fade" id="tickets" role="tabpanel">
                @include('dashboard.partials._tickets')
            </div>

            <!-- Attractions Tab -->
            <div class="tab-pane fade" id="attractions" role="tabpanel">
                @include('dashboard.partials._attractions')
            </div>

            <!-- Shows Tab -->
            <div class="tab-pane fade" id="shows" role="tabpanel">
                @include('dashboard.partials._shows')
            </div>

            <!-- Restaurants Tab -->
            <div class="tab-pane fade" id="restaurants" role="tabpanel">
                @include('dashboard.partials._restaurants')
            </div>

            <!-- Shops Tab -->
            <div class="tab-pane fade" id="shops" role="tabpanel">
                @include('dashboard.partials._shops')
            </div>

            <!-- Services Tab -->
            <div class="tab-pane fade" id="services" role="tabpanel">
                @include('dashboard.partials._services')
            </div>

            <!-- Locations Tab -->
            <div class="tab-pane fade" id="locations" role="tabpanel">
                @include('dashboard.partials._locations')
            </div>

            <!-- Promo Codes Tab -->
            <div class="tab-pane fade" id="promoCodes" role="tabpanel">
                @include('dashboard.partials._promo_codes')
            </div>

            <!-- Visit Histories Tab -->
            <div class="tab-pane fade" id="visitHistories" role="tabpanel">
                @include('dashboard.partials._visit_histories')
            </div>

            <!-- Mock Credit Cards Tab -->
            <div class="tab-pane fade" id="mockCreditCards" role="tabpanel">
                @include('dashboard.partials._mock_credit_cards')
            </div>
        </div>
    </div>

    <!-- Include modals -->
    @include('dashboard.modals._user_form')
    @include('dashboard.modals._order_form')
    @include('dashboard.modals._ticket_form')
    @include('dashboard.modals._attraction_form')
    @include('dashboard.modals._show_form')
    @include('dashboard.modals._restaurant_form')
    @include('dashboard.modals._shop_form')
    @include('dashboard.modals._service_form')
    @include('dashboard.modals._location_form')
    @include('dashboard.modals._promo_code_form')
    @include('dashboard.modals._visit_history_form')
    @include('dashboard.modals._mock_credit_card_form')
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/tabs.js') }}"></script>
    
    <!-- File di utilità per le API -->
    <script src="{{ asset('js/dashboard/api/api-utils.js') }}"></script>
    
    <!-- File specifici per ogni tipo di API -->
    <script src="{{ asset('js/dashboard/api/user-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/order-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/ticket-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/attraction-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/show-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/restaurant-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/shop-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/service-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/location-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/promo-code-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/visit-history-api.js') }}"></script>
    <script src="{{ asset('js/dashboard/api/mock-credit-card-api.js') }}"></script>
    
    
    <!-- File di utilità per i modali -->
    <script src="{{ asset('js/dashboard/modals/modal-utils.js') }}"></script>

    <!-- File specifici per ogni tipo di modale -->
    <script src="{{ asset('js/dashboard/modals/order-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/ticket-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/attraction-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/show-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/restaurant-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/shop-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/service-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/location-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/promo-code-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/visit-history-modals.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals/mock-credit-card-modals.js') }}"></script>

@endsection
