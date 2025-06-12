// This file handles the tab functionality
$(document).ready(function() {
    // Applica i fix jQuery prima di qualsiasi altra operazione
    if (typeof ModalUtils !== 'undefined' && ModalUtils.initializeJQueryFixes) {
        ModalUtils.initializeJQueryFixes();
    }
    
    // Fix for the "Illegal invocation" error in Bootstrap tabs
    // The error occurs because of context issues with 'this' in the selector-engine.js
    
    // Previeni l'inizializzazione automatica dei tab di Bootstrap
    // che potrebbe causare conflitti con la nostra implementazione manuale
    if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
        // Disabilita l'inizializzazione automatica dei tab
        $(document).off('click.bs.tab.data-api', '[data-bs-toggle="tab"]');
    }
    
    // Instead of relying on Bootstrap's automatic tab activation via data attributes,
    // we'll manually handle the tab switching
    $('.sidebar-menu a').on('click', function(e) {
        e.preventDefault();
        
        // Get the target tab ID in modo sicuro
        const tabId = $(this).attr('href') || '#dashboard';
        const currentTab = window.location.hash || '#dashboard';
        
        // Remove active class from all sidebar links and add to clicked one
        $('.sidebar-menu a').removeClass('active');
        $(this).addClass('active');
        
        // Hide all tab panes and show the target one
        $('.tab-pane').removeClass('show active');
        $(tabId).addClass('show active');
        
        // AGGIUNTO: Reset della paginazione SOLO quando si cambia tab (non quando si rimane sulla stessa)
        if (currentTab !== tabId) {
            // Stiamo cambiando tab, quindi resettiamo alla pagina 1
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('page'); // Rimuovi il parametro page
            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '') + tabId;
            window.location.href = newUrl;
            return;
        }
        
        // Se siamo sulla stessa tab, aggiorna solo l'hash senza ricaricare
        history.pushState(null, null, tabId);
    });
    
    // Handle direct URL with hash
    if (window.location.hash) {
        const tabId = window.location.hash;
        $('.sidebar-menu a[href="' + tabId + '"]').click();
    }
    
    // Handle pagination links to maintain tab state
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault(); // Previeni il comportamento predefinito
        
        // Get the current hash/tab
        const currentTab = window.location.hash || '#dashboard';
        
        let href = $(this).attr('href');
        
        // Se l'URL non contiene già un hash, aggiungi il tab corrente
        if (href.indexOf('#') === -1) {
            href = href + currentTab;
        }
        
        // Naviga all'URL modificato
        window.location.href = href;
    });
});