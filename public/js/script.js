document.addEventListener("DOMContentLoaded", () => {
    const elements = initElements();
    const {
        productContainer, cartButton, cart, cartItems,
        cartTotal, cartCount, payButton, searchInput, themeToggle,
        body, confirmModal, closeModal, confirmItems,
        userNameInput, sendOrderButton
    } = elements;

    const PHONE_NUMBER = "+56931712559";
    const DEADLINE = new Date("2024-12-11T10:00:00");
    let cartData = safeGetLocalStorage("cartData");

    initTheme();
    initDeadlineCheck();
    initEventListeners();

    updateCart();


    /* ----- Funciones de inicialización ----- */
    function initElements() {
        return {
            productContainer: document.getElementById("productContainer"),
            cartButton: document.getElementById("toggleCart"),
            cart: document.getElementById("cart"),
            cartItems: document.getElementById("cartItems"),
            cartTotal: document.getElementById("cartTotal"),
            cartCount: document.getElementById("cartCount"),
            payButton: document.getElementById("payButton"),
            searchInput: document.getElementById("searchInput"),
            themeToggle: document.getElementById("themeToggle"),
            body: document.getElementById("body"),
            confirmModal: document.getElementById("confirmModal"),
            closeModal: document.querySelector(".close-modal"),
            confirmItems: document.getElementById("confirmItems"),
            userNameInput: document.getElementById("userName"),
            sendOrderButton: document.getElementById("sendOrder"),
        };
    }

    function initEventListeners() {
        // Alternar carrito
        cartButton.addEventListener("click", (e) => {
            e.stopPropagation();
            toggleVisibility(cart, "hidden");
        });

        // Cerrar carrito al hacer clic fuera
        document.addEventListener("click", (e) => {
            if (!cart.contains(e.target) && !cartButton.contains(e.target) && !cart.classList.contains("hidden")) {
                cart.classList.add("hidden");
            }
        });

        // Filtrado de productos
        searchInput.addEventListener("input", filterProducts);

        // Eventos en productos (añadir, sumar/restar cantidad, actualizar precio)
        productContainer.addEventListener("click", handleProductEvents);

        // Botón de pagar
        payButton.addEventListener("click", showConfirmModal);

        // Cerrar modal
        closeModal.addEventListener("click", () => confirmModal.style.display = "none");

        // Enviar pedido
        sendOrderButton.addEventListener("click", sendOrder);

        // Cambiar tema
        themeToggle.addEventListener("click", toggleTheme);

        // Cerrar modal al hacer clic fuera
        window.addEventListener("click", (e) => {
            if (e.target === confirmModal) confirmModal.style.display = "none";
        });

        // Eliminar ítems del carrito
        document.addEventListener("click", (e) => {
            const removeBtn = e.target.closest(".remove-btn");
            if (!removeBtn) return;

            const name = removeBtn.dataset.name;
            const agregado = JSON.parse(removeBtn.dataset.agregado);

            cartData = cartData.filter(
                (item) => !(item.name === name && JSON.stringify(item.agregado) === JSON.stringify(agregado))
            );
            updateCart();
            showNotification("Producto eliminado del carrito.", "success");
        });
    }

    function initTheme() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme) {
            body.classList.add(savedTheme);
            updateThemeIcon(savedTheme);
        } else if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
            body.classList.add("dark");
            updateThemeIcon("dark");
        }
    }

    function initDeadlineCheck() {
        checkDeadline();
        setInterval(checkDeadline, 60000); // Verificación periódica cada minuto
    }


    /* ----- Funciones de utilidad ----- */
    function safeGetLocalStorage(key) {
        try {
            return JSON.parse(localStorage.getItem(key)) || [];
        } catch (error) {
            console.error("Error al leer el almacenamiento local", error);
            return [];
        }
    }

    function toggleVisibility(element, className) {
        element.classList.toggle(className);
    }

    function updateThemeIcon(theme) {
        themeToggle.innerHTML =
            theme === "dark" ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    }

    function capitalizeWords(str) {
        return str
            .toLowerCase()
            .split(" ")
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(" ");
    }


    /* ----- Lógica de Tema ----- */
    function toggleTheme() {
        body.classList.toggle("dark");
        const currentTheme = body.classList.contains("dark") ? "dark" : "light";
        updateThemeIcon(currentTheme);
        localStorage.setItem("theme", currentTheme);
    }


    /* ----- Lógica de filtrado de productos ----- */
    function filterProducts() {
        const filter = searchInput.value.toLowerCase();
        document.querySelectorAll(".sandwich-card").forEach((card) => {
            const match = card.dataset.name.toLowerCase().includes(filter);
            card.style.display = match ? "block" : "none";
        });
    }


    /* ----- Lógica de Productos y Carrito ----- */
    function handleProductEvents(e) {
        const card = e.target.closest(".sandwich-card");
        if (!card) return;

        const quantityElement = card.querySelector(".quantity");
        const basePrice = parseFloat(card.dataset.price);

        if (e.target.closest(".plus-btn")) {
            updateQuantity(quantityElement, 1, basePrice, card);
        } else if (e.target.closest(".minus-btn")) {
            updateQuantity(quantityElement, -1, basePrice, card);
        } else if (e.target.closest(".add-to-cart")) {
            addToCart(card, basePrice, quantityElement);
        } else if (e.target.closest(".agregado")) {
            updateCardTotalPrice(card, basePrice);
        }
    }

    function updateQuantity(quantityElement, delta, basePrice, card) {
        let quantity = parseInt(quantityElement.textContent);
        quantity = Math.max(1, Math.min(quantity + delta, 100));
        quantityElement.textContent = quantity;
        updateCardTotalPrice(card, basePrice);
    }

    function addToCart(card, basePrice, quantityElement) {
        const name = card.querySelector("h2").textContent;
        const quantity = parseInt(quantityElement.textContent);
        const agregado = getSelectedAgregado(card);

        const existingItem = cartData.find(
            (item) => item.name === name && item.agregado.name === agregado.name
        );

        if (existingItem) {
            existingItem.quantity = Math.min(existingItem.quantity + quantity, 100);
        } else {
            cartData.push({ name, basePrice, quantity, agregado });
        }

        updateCart();
        showNotification(`${name} añadido al carrito`, "success");

        clearAgregadoOptions(card);
        resetCard(card, quantityElement);
    }

    function clearAgregadoOptions(card) {
        card.querySelectorAll(".agregado").forEach((radio) => (radio.checked = false));
    }

    function getSelectedAgregado(card) {
        const agregadoRadioButtons = card.querySelectorAll(".agregado");
        let agregado = { name: "Sin agregado", price: 0 };

        agregadoRadioButtons.forEach((radio) => {
            if (radio.checked) {
                agregado = {
                    name: radio.dataset.name,
                    price: parseInt(radio.dataset.price),
                };
            }
        });
        return agregado;
    }

    function resetCard(card, quantityElement) {
        quantityElement.textContent = "1";
        card.querySelectorAll(".agregado").forEach((radio) => {
            if (radio.dataset.name === "Sin agregado") {
                radio.checked = true;
            }
        });
        updateCardTotalPrice(card, parseFloat(card.dataset.price));
    }

    function updateCardTotalPrice(card, basePrice) {
        const agregadoPrice = getSelectedAgregado(card).price;
        const quantity = parseInt(card.querySelector(".quantity").textContent);
        const totalPrice = (basePrice + agregadoPrice) * quantity;
        card.querySelector(".total-price").textContent = `$${totalPrice.toLocaleString("es-CL")}`;
    }

    function updateCart() {
        cartItems.innerHTML = "";
        let total = 0;
        let count = 0;

        cartData.forEach((item) => {
            const itemTotal = (item.basePrice + item.agregado.price) * item.quantity;
            total += itemTotal;
            count += item.quantity;

            cartItems.innerHTML += `
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <span>${item.name}${item.agregado.name === "Sin agregado" ? ` x${item.quantity}` : ""}</span>
                        <div>${item.agregado.name !== "Sin agregado" ? `+ ${item.agregado.name} x${item.quantity}` : ""}</div>
                    </div>
                    <div class="flex items-center">
                        <span>$${itemTotal.toLocaleString("es-CL")}</span>
                        <button class="remove-btn text-red-500 ml-4" data-name="${item.name}" data-agregado='${JSON.stringify(item.agregado)}'>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>`;
        });

        cartTotal.textContent = `$${total.toLocaleString("es-CL")}`;
        cartCount.textContent = count;
        cartCount.style.display = count > 0 ? "flex" : "none";

        localStorage.setItem("cartData", JSON.stringify(cartData));

        // Limpieza de caché (si es necesario)
        caches.keys().then(cacheNames => {
            cacheNames.forEach(cacheName => caches.delete(cacheName));
        });
    }


    /* ----- Lógica de Confirmación y Envío de Pedido ----- */
    function showConfirmModal() {
        if (cartData.length === 0) {
            showNotification("El carrito está vacío", "error");
            return;
        }

        confirmItems.innerHTML = "";
        let total = 0;

        cartData.forEach((item) => {
            const itemTotal = (item.basePrice + item.agregado.price) * item.quantity;
            total += itemTotal;

            confirmItems.innerHTML += `
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <span>${item.name}${item.agregado.name === "Sin agregado" ? ` x${item.quantity}` : ""}</span>
                        <div>${item.agregado.name !== "Sin agregado" ? `+ ${item.agregado.name} x${item.quantity}` : ""}</div>
                    </div>
                    <span>$${itemTotal.toLocaleString("es-CL")}</span>
                </div>
                <hr>`;
        });

        document.getElementById("modalTotal").textContent = `$${total.toLocaleString("es-CL")}`;
        confirmModal.style.display = "block";
    }

    function sendOrder() {
        const userName = capitalizeWords(userNameInput.value.trim());
        if (!userName) {
            showNotification("Por favor, ingresa tu nombre.", "error");
            return;
        }

        let total = 0;
        let message = `Hola, soy ${userName}. Me gustaría realizar el siguiente pedido:\n\n`;

        cartData.forEach((item) => {
            const itemTotal = (item.basePrice + item.agregado.price) * item.quantity;
            total += itemTotal;
            message += `${item.name} + ${item.agregado.name} x${item.quantity} - $${itemTotal.toLocaleString("es-CL")}\n`;
        });

        message += `\nTotal: $${total.toLocaleString("es-CL")}`;

        const waUrl = `https://wa.me/${PHONE_NUMBER.replace(/[^\d]/g, "")}?text=${encodeURIComponent(message)}`;
        const waWindow = window.open(waUrl, "_blank");

        if (!waWindow) {
            showNotification("Por favor, habilita las ventanas emergentes para enviar el pedido por WhatsApp.", "error");
        } else {
            clearCart();
            confirmModal.style.display = "none";
            userNameInput.value = "";
        }
    }

    function clearCart() {
        cartData = [];
        updateCart();
        showNotification("Pedido enviado, carrito vaciado", "success");
    }


    /* ----- Notificaciones ----- */
    function showNotification(message, type = "success") {
        const notification = document.createElement("div");
        notification.className = `notification ${type === "success" ? "bg-green-500" : "bg-red-500"} text-white p-3 rounded shadow-lg fixed top-4 right-4 z-50 transition-all duration-500 transform translate-x-full opacity-0`;
        notification.innerHTML = `<span>${message}</span>`;
        document.body.appendChild(notification);

        requestAnimationFrame(() => {
            notification.style.transform = "translateX(0)";
            notification.style.opacity = "1";
        });

        setTimeout(() => {
            notification.style.transform = "translateX(100%)";
            notification.style.opacity = "0";
            setTimeout(() => notification.remove(), 500);
        }, 5000);
    }


    /* ----- Verificación de fecha límite ----- */
    function checkDeadline() {
        const now = new Date();
        if (now >= DEADLINE) {
            sendOrderButton.disabled = true;
            sendOrderButton.classList.add("bg-gray-400", "cursor-not-allowed");
            sendOrderButton.classList.remove("bg-green-500");
            sendOrderButton.textContent = "Pedidos Cerrados";
        }
    }
});
