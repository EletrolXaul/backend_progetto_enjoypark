// This file handles all API calls for CRUD operations
$(document).ready(function () {
    // User API calls
    window.userApi = {
        // Add User
        addUser: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/users",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Update User
        updateUser: function (
            userId,
            formData,
            successCallback,
            errorCallback
        ) {
            // Convert formData string to object to handle checkbox properly
            const data = {};
            const pairs = formData.split('&');
            
            pairs.forEach(pair => {
                const [key, value] = pair.split('=');
                if (key && value !== undefined) {
                    data[decodeURIComponent(key)] = decodeURIComponent(value.replace(/\+/g, ' '));
                }
            });
            
            // Ensure is_admin is always present as boolean
            data.is_admin = $('#edit_is_admin').is(':checked') ? 1 : 0;
            
            $.ajax({
                url: `/users/${userId}`,
                type: "PUT",
                data: data,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Delete User
        deleteUser: function (userId, successCallback, errorCallback) {
            $.ajax({
                url: `/users/${userId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione dell'utente."
                        );
                },
            });
        },
    };

    // Order API calls
    window.orderApi = {
        // Add Order
        addOrder: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/orders",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Update Order
        updateOrder: function (
            orderId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/orders/${orderId}`, // Rimuovi /api/ prefix per usare route web
                type: "PUT",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Delete Order
        deleteOrder: function (orderId, successCallback, errorCallback) {
            $.ajax({
                url: `/orders/${orderId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione dell'ordine"
                        );
                },
            });
        },
    };

    // Ticket API calls
    window.ticketApi = {
        // Add Ticket
        addTicket: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/tickets",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Update Ticket
        updateTicket: function (
            ticketId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/tickets/${ticketId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Delete Ticket
        deleteTicket: function (ticketId, successCallback, errorCallback) {
            $.ajax({
                url: `/tickets/${ticketId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione del biglietto"
                        );
                },
            });
        },
    };

    // Show API calls
    window.showApi = {
        // Add Show
        addShow: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/shows",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Update Show
        updateShow: function (
            showId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/shows/${showId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },

        // Delete Show
        deleteShow: function (showId, successCallback, errorCallback) {
            $.ajax({
                url: `/shows/${showId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione dello spettacolo"
                        );
                },
            });
        },
    };

    // Restaurant API calls
    window.restaurantApi = {

        // Update Restaurant
        updateRestaurant: function (
            restaurantId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/restaurants/${restaurantId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";

                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }

                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
    };

    // Implementazioni simili per Shop, Service, Location, PromoCode, VisitHistory e MockCreditCard
    // Shop API calls
    window.shopApi = {
        updateShop: function (
            shopId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/shops/${shopId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
    };

    // Service API calls
    window.serviceApi = {
        updateService: function (
            serviceId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/services/${serviceId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
    };

    // PromoCode API calls
    window.promoCodeApi = {
        addPromoCode: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/promo-codes",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        updatePromoCode: function (
            promoCodeId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/promo-codes/${promoCodeId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        deletePromoCode: function (
            promoCodeId,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/promo-codes/${promoCodeId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione del codice promozionale"
                        );
                },
            });
        },
    };

    // VisitHistory API calls
    window.visitHistoryApi = {
        addVisitHistory: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/visit-histories",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        updateVisitHistory: function (
            visitHistoryId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/visit-histories/${visitHistoryId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        deleteVisitHistory: function (
            visitHistoryId,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/visit-histories/${visitHistoryId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione della cronologia visite"
                        );
                },
            });
        },
    };

    // MockCreditCard API calls
    window.mockCreditCardApi = {
        addMockCreditCard: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/mock-credit-cards",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        updateMockCreditCard: function (
            mockCreditCardId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/mock-credit-cards/${mockCreditCardId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        deleteMockCreditCard: function (
            mockCreditCardId,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/mock-credit-cards/${mockCreditCardId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback)
                        errorCallback(
                            "Errore durante l'eliminazione della carta di credito"
                        );
                },
            });
        },
    };

    // Attraction API calls
    window.attractionApi = {
        addAttraction: function (formData, successCallback, errorCallback) {
            $.ajax({
                url: "/attractions",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        updateAttraction: function (
            attractionId,
            formData,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/attractions/${attractionId}`,
                type: "PUT",
                data: formData,
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage =
                            "Si sono verificati i seguenti errori:<ul>";
                        for (const key in errors) {
                            errorMessage += `<li>${errors[key]}</li>`;
                        }
                        errorMessage += "</ul>";
                        errorCallback(errorMessage);
                    }
                },
            });
        },
        deleteAttraction: function (
            attractionId,
            successCallback,
            errorCallback
        ) {
            $.ajax({
                url: `/attractions/${attractionId}`,
                type: "DELETE",
                success: function (response) {
                    if (successCallback) successCallback(response);
                },
                error: function (xhr) {
                    if (errorCallback) errorCallback("Errore durante l'eliminazione dell'attrazione");
                },
            });
        },
    };
});
