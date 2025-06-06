// Set up CSRF token for all AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Show alert function
function showAlert(message, type = 'success') {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show custom-alert" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $('.alert-container').append(alertHtml);
    
    // Auto dismiss after 5 seconds
    setTimeout(function() {
        $('.custom-alert').alert('close');
    }, 5000);
}

// Make showAlert available globally
window.showAlert = showAlert;