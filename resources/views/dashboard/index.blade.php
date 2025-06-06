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
                            @foreach($stats['recentOrders'] as $order)
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
                            @foreach($stats['recentUsers'] as $user)
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

            <!-- Attractions Tab -->
            <div class="tab-pane fade" id="attractions" role="tabpanel">
                @include('dashboard.partials._attractions')
            </div>

            <!-- Add other tabs here -->
            <!-- Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <!-- Include orders partial -->
            </div>
            
            <!-- Continue with other tabs -->
        </div>
    </div>

    <!-- Include modals -->
    @include('dashboard.modals._user_form')
    @include('dashboard.modals._attraction_form')
    <!-- Include other modals -->
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/tabs.js') }}"></script>
    <script src="{{ asset('js/dashboard/api.js') }}"></script>
    <script src="{{ asset('js/dashboard/modals.js') }}"></script>
@endsection