// This file handles all modal interactions

// Fix per errore "Illegal invocation" di Bootstrap
$(document).ready(function () {
    // Previeni l'errore di contesto di Bootstrap
    const originalFind = $.fn.find;
    $.fn.find = function (selector) {
        return originalFind.call(this, selector);
    };
    // User Modals

    // Add User
    $("#saveUserBtn").click(function () {
        const formData = $("#addUserForm").serialize();

        userApi.addUser(
            formData,
            function (response) {
                $("#addUserModal").modal("hide");
                showAlert("Utente aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit User - Load Data
    $(".edit-user").click(function () {
        const userId = $(this).data("id");
        const row = $(this).closest("tr");

        $("#edit_user_id").val(userId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_email").val(row.find("td:eq(2)").text());
        $("#edit_membership").val(row.find("td:eq(3)").text().toLowerCase());
        $("#edit_is_admin").prop(
            "checked",
            row.find("td:eq(4)").text() === "Sì"
        );
    });

    // Update User
    $("#updateUserBtn").click(function () {
        const userId = $("#edit_user_id").val();
        const formData = $("#editUserForm").serialize();

        userApi.updateUser(
            userId,
            formData,
            function (response) {
                $("#editUserModal").modal("hide");
                showAlert("Utente aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete User
    $(".delete-user").click(function () {
        if (confirm("Sei sicuro di voler eliminare questo utente?")) {
            const userId = $(this).data("id");

            userApi.deleteUser(
                userId,
                function (response) {
                    showAlert("Utente eliminato con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // Order Modals

    // Add Order
    $("#saveOrderBtn").click(function () {
        const formData = $("#addOrderForm").serialize();

        orderApi.addOrder(
            formData,
            function (response) {
                $("#addOrderModal").modal("hide");
                showAlert("Ordine aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit Order - Load Data
    // Nel click handler di .edit-order (riga ~102)
    $(".edit-order").click(function () {
        const orderId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_order_id").val(orderId);

        // Correzione: Utente è nella colonna 2, non 1
        const userCell = row.find("td:eq(2)");
        const userId = userCell.data("user-id"); // Usa il data-user-id invece del testo
        $("#edit_user_id").val(userId);

        // Correzione: Prezzo totale è nella colonna 3, rimuovi il simbolo €
        const priceText = row.find("td:eq(3)").text().replace("€", "").trim();
        $("#edit_total_price").val(priceText);

        // Correzione: Stato è nella colonna 4, usa il data-status attribute della cella
        const statusCell = row.find("td:eq(4)");
        const statusValue = statusCell.data("status");
        console.log("Status value from cell:", statusValue);
        $("#edit_status").val(statusValue);

        // Verifica che il valore sia stato impostato correttamente
        setTimeout(() => {
            console.log("Selected status:", $("#edit_status").val());
        }, 100);

        $("#editOrderModal").modal("show");
    });

    // Update Order
    $("#updateOrderBtn").click(function () {
        const orderId = $("#edit_order_id").val();
        const formData = $("#editOrderForm").serialize();

        orderApi.updateOrder(
            orderId,
            formData,
            function (response) {
                $("#editOrderModal").modal("hide");
                showAlert("Ordine aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete Order
    $(".delete-order").click(function () {
        const orderId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo ordine?")) {
            orderApi.deleteOrder(
                orderId,
                function (response) {
                    showAlert("Ordine eliminato con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // Ticket Modals

    // Add Ticket
    $("#saveTicketBtn").click(function () {
        const formData = $("#addTicketForm").serialize();

        ticketApi.addTicket(
            formData,
            function (response) {
                $("#addTicketModal").modal("hide");
                showAlert("Biglietto aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit Ticket - Load Data
    $(".edit-ticket").click(function () {
        const ticketId = $(this).data("id");
        const row = $(this).closest("tr");

        $("#edit_ticket_id").val(ticketId);
        $("#edit_code").val(row.find("td:eq(1)").text());
        $("#edit_type").val(row.find("td:eq(2)").text());
        $("#edit_price").val(row.find("td:eq(3)").text().replace("€", ""));
        $("#edit_validity").val(row.find("td:eq(4)").text());

        $("#editTicketModal").modal("show");
    });

    // Update Ticket
    $("#updateTicketBtn").click(function () {
        const ticketId = $("#edit_ticket_id").val();
        const formData = $("#editTicketForm").serialize();

        ticketApi.updateTicket(
            ticketId,
            formData,
            function (response) {
                $("#editTicketModal").modal("hide");
                showAlert("Biglietto aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete Ticket
    $(".delete-ticket").click(function () {
        const ticketId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo biglietto?")) {
            ticketApi.deleteTicket(
                ticketId,
                function (response) {
                    showAlert("Biglietto eliminato con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // Show Modals

    // Add Show - moved to end of file

    // Edit Show - Load Data (CORRETTA)
    $(".edit-show").click(function () {
        const $this = $(this);
        const showId = $this.data("id");
        const showName = $this.data("name");
        const showSlug = $this.data("slug");
        const showDescription = $this.data("description");
        const showVenue = $this.data("venue");
        const showDuration = $this.data("duration");
        const showCategory = $this.data("category");
        const showTimes = $this.data("times");
        const showCapacity = $this.data("capacity");
        const showAvailableSeats = $this.data("available-seats");
        const showRating = $this.data("rating");
        const showPrice = $this.data("price");
        const showAgeRestriction = $this.data("age-restriction");
        const showLocationX = $this.data("location-x");
        const showLocationY = $this.data("location-y");
        const showImage = $this.data("image");

        // Popola i campi del form di modifica
        $("#edit_show_id").val(showId);
        $("#edit_show_name").val(showName);
        $("#edit_show_slug").val(showSlug);
        $("#edit_show_description").val(showDescription);
        $("#edit_show_venue").val(showVenue);
        $("#edit_show_duration").val(showDuration);
        $("#edit_show_category").val(showCategory);
        $("#edit_show_capacity").val(showCapacity);
        $("#edit_show_available_seats").val(showAvailableSeats);
        $("#edit_show_rating").val(showRating);
        $("#edit_show_price").val(showPrice);
        $("#edit_show_age_restriction").val(showAgeRestriction);
        $("#edit_show_location_x").val(showLocationX);
        $("#edit_show_location_y").val(showLocationY);
        $("#edit_show_image").val(showImage);

        // Gestisci gli orari (times) - VERSIONE SEMPLIFICATA
        if (showTimes) {
            $("#edit_show_times").val(showTimes);
        }

        $("#editShowModal").modal("show");
    });

    // Update Show
    $("#updateShowBtn").click(function () {
        const showId = $("#edit_show_id").val();

        // Serializza i dati del form
        let formData = $("#editShowForm").serializeArray();

        // Converti la stringa times in array
        const timesIndex = formData.findIndex((item) => item.name === "times");
        if (timesIndex !== -1) {
            const timesString = formData[timesIndex].value;
            // Rimuovi il campo times dalla serializzazione
            formData.splice(timesIndex, 1);

            // Aggiungi ogni orario come elemento separato dell'array
            if (timesString) {
                const timesArray = timesString
                    .split(",")
                    .map((time) => time.trim());
                timesArray.forEach((time, index) => {
                    formData.push({
                        name: `times[${index}]`,
                        value: time,
                    });
                });
            }
        }

        // Converti l'array in formato per jQuery
        const serializedData = $.param(formData);

        showApi.updateShow(
            showId,
            serializedData,
            function (response) {
                $("#editShowModal").modal("hide");
                showAlert("Spettacolo aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete Show
    $(".delete-show").click(function () {
        const showId = $(this).data("id");

        if (confirm("Sei sicuro di voler eliminare questo spettacolo?")) {
            showApi.deleteShow(
                showId,
                function (response) {
                    showAlert("Spettacolo eliminato con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // Edit PromoCode - Load Data usando data attributes
    $(document).on("click", ".edit-promo-code", function () {
        const $this = $(this);
        const promoCodeId = $this.attr("data-id");

        // Debug: stampa tutti i data attributes
        console.log("PromoCode data:", {
            id: promoCodeId,
            code: $this.attr("data-code"),
            description: $this.attr("data-description"),
            discount: $this.attr("data-discount"),
            type: $this.attr("data-type"),
            validUntil: $this.attr("data-valid-until"),
            minAmount: $this.attr("data-min-amount"),
            maxDiscount: $this.attr("data-max-discount"),
            usageLimit: $this.attr("data-usage-limit"),
            usedCount: $this.attr("data-used-count"),
            isActive: $this.attr("data-is-active"),
        });

        // Popola i campi usando i data attributes dalla tabella migliorata
        $("#edit_promo_code_id").val(promoCodeId);
        $("#edit_code").val($this.attr("data-code") || "");
        $("#edit_description").val($this.attr("data-description") || "");
        $("#edit_discount").val($this.attr("data-discount") || "");
        $("#edit_type").val($this.attr("data-type") || "percentage");
        $("#edit_valid_until").val($this.attr("data-valid-until") || "");
        $("#edit_min_amount").val($this.attr("data-min-amount") || "");
        $("#edit_max_discount").val($this.attr("data-max-discount") || "");
        $("#edit_usage_limit").val($this.attr("data-usage-limit") || "0");
        $("#edit_used_count").val($this.attr("data-used-count") || "0");

        // CORREZIONE: Gestione corretta del checkbox
        const isActive = $this.attr("data-is-active");
        $("#edit_is_active").prop(
            "checked",
            isActive === "1" || isActive === "true"
        );

        $("#editPromoCodeModal").modal("show");
    });

    // VisitHistory Modals

    // Add VisitHistory
    $("#saveVisitHistoryBtn").click(function () {
        const formData = $("#addVisitHistoryForm").serialize();

        visitHistoryApi.addVisitHistory(
            formData,
            function (response) {
                $("#addVisitHistoryModal").modal("hide");
                showAlert("Visita aggiunta con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit VisitHistory - Load Data usando data attributes
    $(document).on("click", ".edit-visit-history", function () {
        const $this = $(this);
        const visitHistoryId = $this.attr("data-id");

        $("#edit_visit_history_id").val(visitHistoryId);
        $("#edit_user_id").val($this.attr("data-user-id") || "");
        $("#edit_visit_date").val($this.attr("data-visit-date") || "");
        $("#edit_duration").val($this.attr("data-duration") || "");
        $("#edit_rating").val($this.attr("data-rating") || "");
        $("#edit_notes").val($this.attr("data-notes") || "");

        // Gestione attrazioni JSON
        const attractions = $this.attr("data-attractions");
        if (attractions) {
            try {
                const attractionsArray = JSON.parse(attractions);
                $("#edit_attractions").val(
                    JSON.stringify(attractionsArray, null, 2)
                );
            } catch (e) {
                $("#edit_attractions").val(attractions);
            }
        }

        $("#editVisitHistoryModal").modal("show");
    });

    // Update VisitHistory
    $("#updateVisitHistoryBtn").click(function () {
        const visitHistoryId = $("#edit_visit_history_id").val();
        const formData = $("#editVisitHistoryForm").serialize();

        visitHistoryApi.updateVisitHistory(
            visitHistoryId,
            formData,
            function (response) {
                $("#editVisitHistoryModal").modal("hide");
                showAlert("Visita aggiornata con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete VisitHistory
    $(document).on("click", ".delete-visit-history", function () {
        if (confirm("Sei sicuro di voler eliminare questa visita?")) {
            const visitHistoryId = $(this).data("id");

            visitHistoryApi.deleteVisitHistory(
                visitHistoryId,
                function (response) {
                    showAlert("Visita eliminata con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // MockCreditCard Modals

    // Add MockCreditCard
    $("#saveMockCreditCardBtn").click(function () {
        const formData = $("#addMockCreditCardForm").serialize();

        mockCreditCardApi.addMockCreditCard(
            formData,
            function (response) {
                $("#addMockCreditCardModal").modal("hide");
                showAlert("Carta di credito aggiunta con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit MockCreditCard - Load Data usando data attributes
    $(document).on("click", ".edit-mock-credit-card", function () {
        const $this = $(this);
        const mockCreditCardId = $this.attr("data-id");

        $("#edit_mock_credit_card_id").val(mockCreditCardId);
        $("#edit_user_id").val($this.attr("data-user-id") || "");
        $("#edit_card_number").val($this.attr("data-card-number") || "");
        $("#edit_cardholder_name").val(
            $this.attr("data-cardholder-name") || ""
        );
        $("#edit_expiry").val($this.attr("data-expiry-date") || "");
        $("#edit_cvv").val($this.attr("data-cvv") || "");
        $("#edit_card_type").val($this.attr("data-card-type") || "visa");
        $("#edit_balance").val($this.attr("data-balance") || "");
        $("#edit_result").val($this.attr("data-result") || "success");
        $("#edit_message").val($this.attr("data-message") || "");

        $("#editMockCreditCardModal").modal("show");
    });

    // Edit Attraction - Load Data (CORRETTA)
    $(".edit-attraction").click(function () {
        const attractionId = $(this).data("id");
        $("#edit_attraction_id").val(attractionId);
        $("#edit_attraction_name").val($(this).data("name"));
        $("#edit_category").val($(this).data("category"));
        $("#edit_description").val($(this).data("description"));
        $("#edit_capacity").val($(this).data("capacity"));

        // Gestione speciale per la durata
        let duration = $(this).data("duration");
        if (duration) {
            duration = duration.toString().replace(/[^0-9]/g, ""); // Rimuove tutto tranne i numeri
        }
        $("#edit_duration").val(duration);

        $("#edit_min_height").val($(this).data("min-height"));
        $("#edit_wait_time").val($(this).data("wait-time"));
        const status = $(this).data("status");
        console.log("Status:", status);
        $("#edit_status").val(status);

        $("#edit_thrill_level").val($(this).data("thrill-level"));

        // Gestione del campo image con log per debug
        const image = $(this).data("image");
        console.log("Image:", image);
        $("#edit_image").val(image !== undefined ? image : "");

        // Gestione speciale per features (JSON) con log per debug
        let features = $(this).data("features");
        console.log("Features:", features);
        if (typeof features === "object") {
            features = JSON.stringify(features);
        }
        $("#edit_features").val(
            features !== undefined ? features : JSON.stringify([])
        );

        $("#editAttractionModal").modal("show");
    });

    // Add PromoCode
    $("#savePromoCodeBtn").click(function () {
        const formData = $("#addPromoCodeForm").serialize();
        promoCodeApi.addPromoCode(
            formData,
            function (response) {
                $("#addPromoCodeModal").modal("hide");
                showAlert("Codice promo aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Update PromoCode
    $("#updatePromoCodeBtn").click(function () {
        const promoCodeId = $("#edit_promo_code_id").val();
        const formData = $("#editPromoCodeForm").serialize();
        promoCodeApi.updatePromoCode(
            promoCodeId,
            formData,
            function (response) {
                $("#editPromoCodeModal").modal("hide");
                showAlert("Codice promo aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Delete PromoCode
    $(".delete-promo-code").click(function () {
        const promoCodeId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questo codice promo?")) {
            promoCodeApi.deletePromoCode(
                promoCodeId,
                function (response) {
                    showAlert("Codice promo eliminato con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // Update MockCreditCard
    $("#updateMockCreditCardBtn").click(function () {
        const mockCreditCardId = $("#edit_mock_credit_card_id").val();
        const formData = $("#editMockCreditCardForm").serialize();
        mockCreditCardApi.updateMockCreditCard(
            mockCreditCardId,
            formData,
            function (response) {
                $("#editMockCreditCardModal").modal("hide");
                showAlert("Carta di credito aggiornata con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-mock-credit-card").click(function () {
        const mockCreditCardId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questa carta di credito?")) {
            mockCreditCardApi.deleteMockCreditCard(
                mockCreditCardId,
                function (response) {
                    showAlert("Carta di credito eliminata con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });

    // View Credit Card Details - Modal Dettagli Completi
    $(document).on("click", ".view-credit-card-details", function () {
        const $this = $(this);

        // Popola informazioni utente
        $("#detail_user_name").text($this.attr("data-user-name") || "N/A");
        $("#detail_user_email").text($this.attr("data-user-email") || "N/A");
        $("#detail_user_id").text($this.attr("data-user-id") || "N/A");

        // Popola dettagli carta
        $("#detail_card_number").text($this.attr("data-card-number") || "N/A");
        $("#detail_cardholder_name").text(
            $this.attr("data-cardholder-name") || "N/A"
        );
        $("#detail_cvv").text($this.attr("data-cvv") || "N/A");
        $("#detail_expiry").text($this.attr("data-expiry-date") || "N/A");
        $("#detail_card_type").text($this.attr("data-card-type") || "N/A");

        // Popola informazioni finanziarie
        const balance = parseFloat($this.attr("data-balance") || "0");
        $("#detail_balance").text(balance.toFixed(2));

        // Popola risultato test con badge colorato
        const result = $this.attr("data-result") || "success";
        const resultConfig = {
            success: {
                class: "bg-success",
                icon: "fas fa-check",
                text: "Successo",
            },
            declined: {
                class: "bg-danger",
                icon: "fas fa-times",
                text: "Rifiutata",
            },
            error: {
                class: "bg-warning",
                icon: "fas fa-exclamation-triangle",
                text: "Errore",
            },
            insufficient_funds: {
                class: "bg-info",
                icon: "fas fa-credit-card",
                text: "Fondi Insufficienti",
            },
        };
        const config = resultConfig[result] || resultConfig["success"];
        $("#detail_result_badge").html(
            `<span class="badge ${config.class}"><i class="${config.icon} me-1"></i>${config.text}</span>`
        );

        $("#detail_message").text(
            $this.attr("data-message") || "Nessun messaggio"
        );

        // Popola informazioni sistema
        $("#detail_card_id").text($this.attr("data-id") || "N/A");
        $("#detail_created_at").text($this.attr("data-created-at") || "N/A");

        // Mostra il modal
        $("#creditCardDetailsModal").modal("show");
    });

    //Delete Attraction
    $(".delete-attraction").click(function () {
        const attractionId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questa attrazione?")) {
            attractionApi.deleteAttraction(
                attractionId,
                function (response) {
                    showAlert("Attrazione eliminata con successo!");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                function (errorMessage) {
                    showAlert(errorMessage, "danger");
                }
            );
        }
    });
});

// Add Attraction
$("#saveAttractionBtn").click(function () {
    // Gestione automatica dei campi location_x e location_y se vuoti
    if ($("#location_x").val() === "") {
        $("#location_x").val((Math.random() * 100).toFixed(6)); // Genera valore casuale
    }
    if ($("#location_y").val() === "") {
        $("#location_y").val((Math.random() * 100).toFixed(6)); // Genera valore casuale
    }

    // Imposta l'immagine placeholder se il campo è vuoto
    if ($("#image").val() === "") {
        $("#image").val("/placeholder.svg?height=200&width=300");
    }

    // Gestione del campo features prima dell'invio
    const featuresText = $("#features").val();
    try {
        // Se vuoto, imposta un array vuoto
        if (featuresText.trim() === "") {
            $("#features").val(JSON.stringify(["Caratteristica generica"]));
        } else {
            // Tenta di analizzare il JSON
            const featuresArray = JSON.parse(featuresText);
            // Sostituisce il valore nel campo con l'array
            $("#features").val(JSON.stringify(featuresArray));
        }
    } catch (e) {
        // Se non è un JSON valido, mostra un errore
        showAlert(
            "Il campo Caratteristiche deve essere un JSON valido",
            "danger"
        );
        return;
    }

    const formData = $("#addAttractionForm").serialize();
    attractionApi.addAttraction(
        formData,
        function (response) {
            $("#addAttractionModal").modal("hide");
            showAlert("Attrazione aggiunta con successo!");
            setTimeout(function () {
                location.reload();
            }, 1000);
        },
        function (errorMessage) {
            showAlert(errorMessage, "danger");
        }
    );
});

// Update Attraction
$("#updateAttractionBtn").click(function () {
    // Gestione automatica dei campi location_x e location_y se vuoti
    if ($("#edit_location_x").val() === "") {
        $("#edit_location_x").val((Math.random() * 100).toFixed(6)); // Genera valore casuale
    }
    if ($("#edit_location_y").val() === "") {
        $("#edit_location_y").val((Math.random() * 100).toFixed(6)); // Genera valore casuale
    }

    // Imposta l'immagine placeholder se il campo è vuoto
    if ($("#edit_image").val() === "") {
        $("#edit_image").val("/placeholder.svg?height=200&width=300");
    }

    // Gestione del campo features prima dell'invio
    const featuresText = $("#edit_features").val();
    try {
        // Se vuoto, imposta un array vuoto
        if (featuresText.trim() === "") {
            $("#edit_features").val(
                JSON.stringify(["Caratteristica generica"])
            );
        } else {
            // Tenta di analizzare il JSON
            const featuresArray = JSON.parse(featuresText);
            // Sostituisce il valore nel campo con l'array
            $("#edit_features").val(JSON.stringify(featuresArray));
        }
    } catch (e) {
        // Se non è un JSON valido, mostra un errore
        showAlert(
            "Il campo Caratteristiche deve essere un JSON valido",
            "danger"
        );
        return;
    }

    const attractionId = $("#edit_attraction_id").val();
    const formData = $("#editAttractionForm").serialize();
    attractionApi.updateAttraction(
        attractionId,
        formData,
        function (response) {
            $("#editAttractionModal").modal("hide");
            showAlert("Attrazione aggiornata con successo!");
            setTimeout(function () {
                location.reload();
            }, 1000);
        },
        function (errorMessage) {
            showAlert(errorMessage, "danger");
        }
    );
}); // End of document ready function

// Aggiungi queste funzioni per generare slug e coordinate casuali

// Funzione per generare slug dal nome
function generateSlug(name) {
    return name
        .toLowerCase()
        .replace(/[^a-z0-9 -]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-")
        .trim("-");
}

// Funzione per generare coordinate casuali
function generateRandomCoordinates() {
    return {
        x: (Math.random() * 0.002 + 0.499).toFixed(6), // Range: 0.499-0.501
        y: (Math.random() * 0.002 + 0.499).toFixed(6), // Range: 0.499-0.501
    };
}

// Genera coordinate casuali quando si apre il modal di aggiunta spettacolo
$("#addShowModal").on("show.bs.modal", function () {
    const coords = generateRandomCoordinates();
    $("#addShowForm #location_x").val(coords.x);
    $("#addShowForm #location_y").val(coords.y);
});

$("#saveShowBtn").click(function () {
    // Genera slug dal nome
    const name = $("#addShowForm #name").val();
    $("#addShowForm #slug").val(generateSlug(name));

    const formData = $("#addShowForm").serialize();
    showApi.addShow(
        formData,
        function (response) {
            $("#addShowModal").modal("hide");
            showAlert("Spettacolo aggiunto con successo!");
            location.reload();
        },
        function (error) {
            showAlert("Errore nell'aggiunta dello spettacolo", "danger");
        }
    );
});

// Modifica la funzione di caricamento dati per il form di modifica
$(".edit-show").click(function () {
    const showId = $(this).data("id");
    const row = $(this).closest("tr");

    // Recupera i dati dagli attributi data-*
    const name = $(this).data("name");
    const category = $(this).data("category");
    const description = $(this).data("description");
    const venue = $(this).data("venue");
    const times = $(this).data("times");
    const duration = $(this).data("duration");
    const capacity = $(this).data("capacity");
    const availableSeats = $(this).data("available-seats");
    const price = $(this).data("price");
    const rating = $(this).data("rating");
    const ageRestriction = $(this).data("age-restriction");

    // Imposta i valori nel form
    $("#edit_show_id").val(showId);
    $("#edit_name").val(name);
    $("#edit_slug").val(name.toLowerCase().replace(/\s+/g, "-")); // Genera slug dal nome
    $("#edit_description").val(description);
    $("#edit_venue").val(venue);
    $("#edit_category").val(category);
    $("#edit_time").val(times.split(",")[0]); // Prende il primo orario
    $("#edit_duration").val(duration);
    $("#edit_capacity").val(capacity);
    $("#edit_available_seats").val(availableSeats);
    $("#edit_price").val(price);
    $("#edit_age_restriction").val(ageRestriction);

    // Recupera le coordinate e l'immagine tramite AJAX
    $.ajax({
        url: `/shows/${showId}`,
        type: "GET",
        success: function (data) {
            $("#edit_location_x").val(data.location_x);
            $("#edit_location_y").val(data.location_y);
            $("#edit_image").val(data.image);
        },
        error: function () {
            // In caso di errore, imposta valori predefiniti
            $("#edit_location_x").val(45.4);
            $("#edit_location_y").val(9.1);
            $("#edit_image").val("/placeholder.jpg");
        },
    });

    $("#editShowModal").modal("show");
});

// Funzione helper per mappare le features agli ID delle checkbox
function getFeatureCheckboxId(feature) {
    const featureMap = {
        WiFi: "#edit-feature-wifi",
        Terrazza: "#edit-feature-terrazza",
        "Menu bambini": "#edit-feature-menu-bambini",
        Accessibile: "#edit-feature-accessibile",
        Parcheggio: "#edit-feature-parcheggio",
        "Opzioni vegetariane": "#edit-feature-vegetariano",
        "Opzioni vegane": "#edit-feature-vegano",
        "Vista panoramica": null, // Feature personalizzata
        "Cucina italiana": null, // Feature personalizzata
    };
    return featureMap[feature] || null;
}

// Chiama la funzione di debug quando la pagina è caricata
$(document).ready(function () {
    // Funzione per aggiornare il campo hidden degli orari di apertura
    function updateOpeningHours(prefix = "") {
        const days = [];
        if ($(`#${prefix}day-lun`).is(":checked")) days.push("Lun");
        if ($(`#${prefix}day-mar`).is(":checked")) days.push("Mar");
        if ($(`#${prefix}day-mer`).is(":checked")) days.push("Mer");
        if ($(`#${prefix}day-gio`).is(":checked")) days.push("Gio");
        if ($(`#${prefix}day-ven`).is(":checked")) days.push("Ven");
        if ($(`#${prefix}day-sab`).is(":checked")) days.push("Sab");
        if ($(`#${prefix}day-dom`).is(":checked")) days.push("Dom");

        const openTime = $(`#${prefix}opening_time`).val();
        const closeTime = $(`#${prefix}closing_time`).val();

        let openingHoursText = "";
        if (days.length > 0) {
            openingHoursText =
                days.join("-") + ": " + openTime + " - " + closeTime;
        }

        $(`#${prefix}opening_hours`).val(openingHoursText);
    }

    // Funzione per aggiornare il campo hidden delle caratteristiche
    function updateFeatures(prefix = "") {
        const features = [];
        $(`.${prefix}feature-checkbox:checked`).each(function () {
            features.push($(this).val());
        });
        $(`#${prefix}features`).val(JSON.stringify(features));
    }

    // Funzione per parsare gli orari di apertura esistenti
    function parseOpeningHours(openingHoursText, prefix = "") {
        if (!openingHoursText) return;

        // Reset all checkboxes
        $(
            `#${prefix}day-lun, #${prefix}day-mar, #${prefix}day-mer, #${prefix}day-gio, #${prefix}day-ven, #${prefix}day-sab, #${prefix}day-dom`
        ).prop("checked", false);

        // Parse format like "Lun-Mar-Mer: 09:00 - 22:00"
        const parts = openingHoursText.split(":");
        if (parts.length >= 2) {
            const days = parts[0].trim().split("-");
            const times = parts[1].trim().split("-");

            // Check days
            days.forEach((day) => {
                const dayTrim = day.trim();
                if (dayTrim === "Lun")
                    $(`#${prefix}day-lun`).prop("checked", true);
                if (dayTrim === "Mar")
                    $(`#${prefix}day-mar`).prop("checked", true);
                if (dayTrim === "Mer")
                    $(`#${prefix}day-mer`).prop("checked", true);
                if (dayTrim === "Gio")
                    $(`#${prefix}day-gio`).prop("checked", true);
                if (dayTrim === "Ven")
                    $(`#${prefix}day-ven`).prop("checked", true);
                if (dayTrim === "Sab")
                    $(`#${prefix}day-sab`).prop("checked", true);
                if (dayTrim === "Dom")
                    $(`#${prefix}day-dom`).prop("checked", true);
            });

            // Set times
            if (times.length >= 2) {
                const openTime = times[0].trim();
                const closeTime = times[1].trim();
                $(`#${prefix}opening_time`).val(openTime);
                $(`#${prefix}closing_time`).val(closeTime);
            }
        }
    }

    // Funzione per aggiungere una nuova caratteristica personalizzata
    function addCustomFeature(prefix = "") {
        const newFeature = $(`#${prefix}new-feature`).val().trim();
        if (newFeature) {
            // Crea un ID unico per la nuova caratteristica
            const featureId =
                "feature-" + newFeature.toLowerCase().replace(/\s+/g, "-");
            const fullId = prefix + featureId;

            // Controlla se esiste già
            if ($(`#${fullId}`).length === 0) {
                // Crea il nuovo elemento
                const newCheckbox = `
                    <input type="checkbox" class="btn-check ${prefix}feature-checkbox" id="${fullId}" value="${newFeature}" autocomplete="off" checked>
                    <label class="btn btn-outline-secondary btn-sm m-1" for="${fullId}">${newFeature}</label>
                `;
                $(`.${prefix}feature-tags .btn-group`).append(newCheckbox);

                // Aggiungi l'event listener
                $(`#${fullId}`).on("change", function () {
                    updateFeatures(prefix);
                });

                // Aggiorna il campo hidden
                updateFeatures(prefix);

                // Pulisci il campo di input
                $(`#${prefix}new-feature`).val("");
            }
        }
    }

    // Event listeners per il form di aggiunta
    $(
        "#day-lun, #day-mar, #day-mer, #day-gio, #day-ven, #day-sab, #day-dom, #opening_time, #closing_time"
    ).on("change", function () {
        updateOpeningHours();
    });

    $(".feature-checkbox").on("change", function () {
        updateFeatures();
    });

    $("#add-feature-btn").on("click", function () {
        addCustomFeature();
    });

    $("#new-feature").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            addCustomFeature();
        }
    });

    // Event listeners per il form di modifica
    $(
        "#edit-day-lun, #edit-day-mar, #edit-day-mer, #edit-day-gio, #edit-day-ven, #edit-day-sab, #edit-day-dom, #edit_opening_time, #edit_closing_time"
    ).on("change", function () {
        updateOpeningHours("edit-");
    });

    $(".edit-feature-checkbox").on("change", function () {
        updateFeatures("edit-");
    });

    $("#edit-add-feature-btn").on("click", function () {
        addCustomFeature("edit-");
    });

    $("#edit-new-feature").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            addCustomFeature("edit-");
        }
    });
});
