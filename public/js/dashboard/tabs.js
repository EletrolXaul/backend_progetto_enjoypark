// This file handles the tab functionality
$(document).ready(function() {
    // Fix for the "Illegal invocation" error in Bootstrap tabs
    // The error occurs because of context issues with 'this' in the selector-engine.js
    
    // Instead of relying on Bootstrap's automatic tab activation via data attributes,
    // we'll manually handle the tab switching
    $('.sidebar-menu a').on('click', function(e) {
        e.preventDefault();
        
        // Get the target tab ID
        const tabId = $(this).attr('href');
        
        // Remove active class from all sidebar links and add to clicked one
        $('.sidebar-menu a').removeClass('active');
        $(this).addClass('active');
        
        // Hide all tab panes and show the target one
        $('.tab-pane').removeClass('show active');
        $(tabId).addClass('show active');
    });
    
    // Handle direct URL with hash
    if (window.location.hash) {
        const tabId = window.location.hash;
        $('.sidebar-menu a[href="' + tabId + '"]').click();
    }
});