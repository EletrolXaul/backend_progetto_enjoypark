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

    $(".edit-restaurant").click(function () {
        const restaurantId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_restaurant_id").val(restaurantId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editRestaurantModal").modal("show");
    });

    $("#updateRestaurantBtn").click(function () {
        const restaurantId = $("#edit_restaurant_id").val();
        const formData = $("#editRestaurantForm").serialize();
        restaurantApi.updateRestaurant(
            restaurantId,
            formData,
            function (response) {
                $("#editRestaurantModal").modal("hide");
                showAlert("Ristorante aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-restaurant").click(function () {
        const restaurantId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questo ristorante?")) {
            restaurantApi.deleteRestaurant(
                restaurantId,
                function (response) {
                    showAlert("Ristorante eliminato con successo!");
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

    // Shop Modals
    $("#saveShopBtn").click(function () {
        const formData = $("#addShopForm").serialize();
        shopApi.addShop(
            formData,
            function (response) {
                $("#addShopModal").modal("hide");
                showAlert("Negozio aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".edit-shop").click(function () {
        const shopId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_shop_id").val(shopId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editShopModal").modal("show");
    });

    $("#updateShopBtn").click(function () {
        const shopId = $("#edit_shop_id").val();
        const formData = $("#editShopForm").serialize();
        shopApi.updateShop(
            shopId,
            formData,
            function (response) {
                $("#editShopModal").modal("hide");
                showAlert("Negozio aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-shop").click(function () {
        const shopId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questo negozio?")) {
            shopApi.deleteShop(
                shopId,
                function (response) {
                    showAlert("Negozio eliminato con successo!");
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

    // Service Modals
    $("#saveServiceBtn").click(function () {
        const formData = $("#addServiceForm").serialize();
        serviceApi.addService(
            formData,
            function (response) {
                $("#addServiceModal").modal("hide");
                showAlert("Servizio aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".edit-service").click(function () {
        const serviceId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_service_id").val(serviceId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editServiceModal").modal("show");
    });

    $("#updateServiceBtn").click(function () {
        const serviceId = $("#edit_service_id").val();
        const formData = $("#editServiceForm").serialize();
        serviceApi.updateService(
            serviceId,
            formData,
            function (response) {
                $("#editServiceModal").modal("hide");
                showAlert("Servizio aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-service").click(function () {
        const serviceId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questo servizio?")) {
            serviceApi.deleteService(
                serviceId,
                function (response) {
                    showAlert("Servizio eliminato con successo!");
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

    // Location Modals
    $("#saveLocationBtn").click(function () {
        const formData = $("#addLocationForm").serialize();
        locationApi.addLocation(
            formData,
            function (response) {
                $("#addLocationModal").modal("hide");
                showAlert("Posizione aggiunta con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".edit-location").click(function () {
        const locationId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_location_id").val(locationId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editLocationModal").modal("show");
    });

    $("#updateLocationBtn").click(function () {
        const locationId = $("#edit_location_id").val();
        const formData = $("#editLocationForm").serialize();
        locationApi.updateLocation(
            locationId,
            formData,
            function (response) {
                $("#editLocationModal").modal("hide");
                showAlert("Posizione aggiornata con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-location").click(function () {
        const locationId = $(this).data("id");
        if (confirm("Sei sicuro di voler eliminare questa posizione?")) {
            locationApi.deleteLocation(
                locationId,
                function (response) {
                    showAlert("Posizione eliminata con successo!");
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

    // PromoCode Modals
    $("#savePromoCodeBtn").click(function () {
        const formData = $("#addPromoCodeForm").serialize();
        promoCodeApi.addPromoCode(
            formData,
            function (response) {
                $("#addPromoCodeModal").modal("hide");
                showAlert("Codice promozionale aggiunto con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".edit-promo-code").click(function () {
        const promoCodeId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_promo_code_id").val(promoCodeId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editPromoCodeModal").modal("show");
    });

    $("#updatePromoCodeBtn").click(function () {
        const promoCodeId = $("#edit_promo_code_id").val();
        const formData = $("#editPromoCodeForm").serialize();
        promoCodeApi.updatePromoCode(
            promoCodeId,
            formData,
            function (response) {
                $("#editPromoCodeModal").modal("hide");
                showAlert("Codice promozionale aggiornato con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-promo-code").click(function () {
        const promoCodeId = $(this).data("id");
        if (
            confirm("Sei sicuro di voler eliminare questo codice promozionale?")
        ) {
            promoCodeApi.deletePromoCode(
                promoCodeId,
                function (response) {
                    showAlert("Codice promozionale eliminato con successo!");
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

    // VisitHistory Modals
    $("#saveVisitHistoryBtn").click(function () {
        const formData = $("#addVisitHistoryForm").serialize();
        visitHistoryApi.addVisitHistory(
            formData,
            function (response) {
                $("#addVisitHistoryModal").modal("hide");
                showAlert("Cronologia visite aggiunta con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".edit-visit-history").click(function () {
        const visitHistoryId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_visit_history_id").val(visitHistoryId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editVisitHistoryModal").modal("show");
    });

    $("#updateVisitHistoryBtn").click(function () {
        const visitHistoryId = $("#edit_visit_history_id").val();
        const formData = $("#editVisitHistoryForm").serialize();
        visitHistoryApi.updateVisitHistory(
            visitHistoryId,
            formData,
            function (response) {
                $("#editVisitHistoryModal").modal("hide");
                showAlert("Cronologia visite aggiornata con successo!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            function (errorMessage) {
                showAlert(errorMessage, "danger");
            }
        );
    });

    $(".delete-visit-history").click(function () {
        const visitHistoryId = $(this).data("id");
        if (
            confirm("Sei sicuro di voler eliminare questa cronologia visite?")
        ) {
            visitHistoryApi.deleteVisitHistory(
                visitHistoryId,
                function (response) {
                    showAlert("Cronologia visite eliminata con successo!");
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

    $(".edit-mock-credit-card").click(function () {
        const mockCreditCardId = $(this).data("id");
        const row = $(this).closest("tr");
        $("#edit_mock_credit_card_id").val(mockCreditCardId);
        // Popola i campi del form con i dati dalla riga della tabella
        $("#editMockCreditCardModal").modal("show");
    });

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
});
