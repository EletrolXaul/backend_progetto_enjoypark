// This file handles all modal interactions
$(document).ready(function () {
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
    $(".edit-order").click(function () {
        const orderId = $(this).data("id");
        $("#edit_order_id").val(orderId);

        // Qui dovresti caricare i dati dell'ordine dal server o dalla riga della tabella
        // Per semplicità, assumiamo che i dati siano disponibili nella riga della tabella
        const row = $(this).closest("tr");
        $("#edit_user_id").val(row.find("td:eq(2)").data("user-id"));
        $("#edit_total_price").val(
            row.find("td:eq(3)").text().replace("€", "")
        );
        $("#edit_status").val(row.find("td:eq(4)").text().toLowerCase());

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

    // Add Show
    $("#saveShowBtn").click(function () {
        const formData = $("#addShowForm").serialize();

        showApi.addShow(
            formData,
            function (response) {
                $("#addShowModal").modal("hide");
                showAlert("Spettacolo aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit Show - Load Data
    $(".edit-show").click(function () {
        const showId = $(this).data("id");
        const row = $(this).closest("tr");

        $("#edit_show_id").val(showId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_time").val(row.find("td:eq(3)").text());
        $("#edit_duration").val(
            row.find("td:eq(4)").text().replace(" min", "")
        );
        $("#edit_location").val(row.find("td:eq(5)").text());

        $("#editShowModal").modal("show");
    });

    // Update Show
    $("#updateShowBtn").click(function () {
        const showId = $("#edit_show_id").val();
        const formData = $("#editShowForm").serialize();

        showApi.updateShow(
            showId,
            formData,
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

    // Implementazioni simili per Restaurant, Shop, Service, Location, PromoCode, VisitHistory e MockCreditCard
    // Restaurant Modals
    $("#saveRestaurantBtn").click(function () {
        const formData = $("#addRestaurantForm").serialize();
        restaurantApi.addRestaurant(
            formData,
            function (response) {
                $("#addRestaurantModal").modal("hide");
                showAlert("Ristorante aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    // Edit Restaurant - Load Data (CORRETTA)
    $(".edit-restaurant").click(function () {
        const restaurantId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_restaurant_id").val(restaurantId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_capacity").val(row.find("td:eq(3)").text());
        $("#edit_opening_hours").val(row.find("td:eq(4)").text());
        $("#editRestaurantModal").modal("show");
    });

    // Edit Shop - Load Data (CORRETTA)
    $(".edit-shop").click(function () {
        const shopId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_shop_id").val(shopId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_type").val(row.find("td:eq(3)").text());
        $("#editShopModal").modal("show");
    });

    // Edit Service - Load Data (CORRETTA)
    $(".edit-service").click(function () {
        const serviceId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_service_id").val(serviceId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_type").val(row.find("td:eq(3)").text());
        $("#edit_price").val(row.find("td:eq(4)").text().replace("€", ""));
        $("#edit_features").val(row.find("td:eq(5)").text());
        $("#editServiceModal").modal("show");
    });

    // Edit Location - Load Data (CORRETTA)
    $(".edit-location").click(function () {
        const locationId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_location_id").val(locationId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_type").val(row.find("td:eq(3)").text());
        $("#edit_latitude").val(row.find("td:eq(4)").text());
        $("#edit_longitude").val(row.find("td:eq(5)").text());
        $("#edit_metadata").val(row.find("td:eq(6)").text());
        $("#edit_is_visible").prop("checked", row.find("td:eq(7)").text() === "Sì");
        $("#editLocationModal").modal("show");
    });

    // Edit PromoCode - Load Data (CORRETTA)
    $(".edit-promo-code").click(function () {
        const promoCodeId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_promo_code_id").val(promoCodeId);
        $("#edit_code").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_discount_type").val(row.find("td:eq(3)").text());
        $("#edit_discount_value").val(row.find("td:eq(4)").text().replace("%", "").replace("€", ""));
        $("#edit_min_order_amount").val(row.find("td:eq(5)").text().replace("€", ""));
        $("#edit_max_discount").val(row.find("td:eq(6)").text().replace("€", ""));
        $("#edit_valid_until").val(row.find("td:eq(7)").text());
        $("#edit_usage_limit").val(row.find("td:eq(8)").text());
        $("#edit_used_count").val(row.find("td:eq(9)").text());
        $("#edit_is_active").prop("checked", row.find("td:eq(10)").text() === "Attivo");
        $("#editPromoCodeModal").modal("show");
    });

    // Edit VisitHistory - Load Data (CORRETTA)
    $(".edit-visit-history").click(function () {
        const visitHistoryId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_visit_history_id").val(visitHistoryId);
        $("#edit_user_id").val(row.find("td:eq(1)").data("user-id"));
        $("#edit_visit_date").val(row.find("td:eq(2)").text());
        $("#edit_attractions_visited").val(row.find("td:eq(3)").text());
        $("#edit_rating").val(row.find("td:eq(4)").text());
        $("#edit_notes").val(row.find("td:eq(5)").text());
        $("#editVisitHistoryModal").modal("show");
    });

    // Edit MockCreditCard - Load Data (CORRETTA)
    $(".edit-mock-credit-card").click(function () {
        const mockCreditCardId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_mock_credit_card_id").val(mockCreditCardId);
        $("#edit_card_number").val(row.find("td:eq(1)").text());
        $("#edit_cardholder_name").val(row.find("td:eq(2)").text());
        $("#edit_expiry_month").val(row.find("td:eq(3)").text().split("/")[0]);
        $("#edit_expiry_year").val(row.find("td:eq(3)").text().split("/")[1]);
        $("#edit_cvv").val(row.find("td:eq(4)").text());
        $("#edit_balance").val(row.find("td:eq(5)").text().replace("€", ""));
        $("#edit_card_type").val(row.find("td:eq(6)").text());
        $("#edit_message").val(row.find("td:eq(7)").text());
        $("#editMockCreditCardModal").modal("show");
    });

    // Edit Attraction - Load Data (AGGIUNTA)
    $(".edit-attraction").click(function () {
        const attractionId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_attraction_id").val(attractionId);
        $("#edit_name").val(row.find("td:eq(1)").text());
        $("#edit_description").val(row.find("td:eq(2)").text());
        $("#edit_type").val(row.find("td:eq(3)").text());
        $("#edit_duration").val(row.find("td:eq(4)").text().replace(" min", ""));
        $("#edit_capacity").val(row.find("td:eq(5)").text());
        $("#edit_min_age").val(row.find("td:eq(6)").text());
        $("#editAttractionModal").modal("show");
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

    // Aggiungere alla fine del file, prima della chiusura di $(document).ready
    
    // Attraction Modals - FUNZIONI MANCANTI
    $("#saveAttractionBtn").click(function () {
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

    $("#updateAttractionBtn").click(function () {
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
    });

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
