<div class="stats-cards">
    <div class="stat-card">
        <div class="stat-card-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-card-info">
            <h4>{{ $stats['totalUsers'] }}</h4>
            <p>Utenti Totali</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-card-info">
            <h4>{{ $stats['totalOrders'] }}</h4>
            <p>Ordini Totali</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">
            <i class="fas fa-ticket-alt"></i>
        </div>
        <div class="stat-card-info">
            <h4>{{ $stats['totalTickets'] }}</h4>
            <p>Biglietti Venduti</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">
            <i class="fas fa-mountain"></i>
        </div>
        <div class="stat-card-info">
            <h4>{{ $stats['totalAttractions'] }}</h4>
            <p>Attrazioni</p>
        </div>
    </div>
</div>