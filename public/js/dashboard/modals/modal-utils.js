// Utilità condivise per tutti i modali

// Fix per l'errore "Illegal invocation" di Bootstrap 5
const ModalUtils = {
    initializeJQueryFixes: function() {
        // Fix per l'errore "Illegal invocation" di Bootstrap 5
        const originalFind = jQuery.find;
        jQuery.find = function(selector, context, results, seed) {
            if (typeof selector !== 'string') {
                try {
                    return originalFind(selector, context, results, seed);
                } catch (e) {
                    console.warn('Errore jQuery.find con selettore non stringa evitato:', e);
                    return [];
                }
            }
            try {
                return originalFind(selector, context, results, seed);
            } catch (e) {
                console.warn('Errore jQuery.find evitato:', e);
                return [];
            }
        };
        
        // Fix completo per l'errore "matchesSelector is not a function"
        // Questo fix funziona sia con jQuery normale che minificato (dove S.find è usato invece di jQuery.find)
        const jQueryFind = jQuery.find || (typeof S !== 'undefined' ? S.find : null);
        if (jQueryFind && !jQueryFind.matchesSelector) {
            jQueryFind.matchesSelector = function(elem, expr) {
                if (!elem) return false;
                try {
                    // Prova prima con matches
                    if (jQueryFind.matches) {
                        return jQueryFind.matches(expr, [elem]).length > 0;
                    }
                    // Fallback a Element.matches nativo se disponibile
                    else if (elem.matches) {
                        return elem.matches(expr);
                    }
                    // Fallback a msMatchesSelector per IE
                    else if (elem.msMatchesSelector) {
                        return elem.msMatchesSelector(expr);
                    }
                    return false;
                } catch (e) {
                    console.warn('Errore matchesSelector evitato:', e);
                    return false;
                }
            };
        }
        
        // Fix per l'errore "attr is not a function"
        if (jQueryFind && !jQueryFind.attr) {
            jQueryFind.attr = function(elem, name) {
                if (!elem) return null;
                try {
                    return elem.getAttribute(name);
                } catch (e) {
                    console.warn('Errore attr evitato:', e);
                    return null;
                }
            };
        }
    },

    // Gestore per la selezione delle icone
    initializeIconHandlers: function() {
        $(document).on("click", "[data-icon]", function (e) {
            e.preventDefault();
            const icon = $(this).data("icon");
            const target = $(this).data("target") || "icon";
            $(`#${target}`).val(icon);
        });

        // Gestione separata per i dropdown delle icone
        $(document).on("click", "[data-icon]", function (e) {
            e.preventDefault();
            const icon = $(this).data("icon");
            const target = $(this).data("target");

            // Se ha un target specifico, usalo
            if (target) {
                $("#" + target).val(icon);
            } else {
                // Fallback: trova il campo icona più vicino
                const iconField = $(this)
                    .closest(".modal")
                    .find('input[name="icon"]');
                if (iconField.length > 0) {
                    iconField.val(icon);
                }
            }
        });
    },

    // Mappa categoria -> icona
    categoryIconMap: {
        Servizi: "🚻",
        Famiglia: "🍼",
        Informazioni: "ℹ️",
        Parcheggio: "🚗",
        Medico: "🏥",
        Assistenza: "🔍",
        Accessibilità: "♿",
        Deposito: "🔒",
        "Servizi Finanziari": "💳",
    },

    // Funzioni di utilità comuni
    showSuccessAndReload: function(message, delay = 1000) {
        showAlert(message);
        setTimeout(function () {
            location.reload();
        }, delay);
    },

    showError: function(errorMessage) {
        showAlert(errorMessage, "danger");
    }
};

// Inizializza le utilità quando il documento è pronto
$(document).ready(function() {
    ModalUtils.initializeJQueryFixes();
    ModalUtils.initializeIconHandlers();
});