<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Disfruta de los mejores sándwiches en nuestro menú. ¡Pide ahora!" />
    <meta name="keywords" content="sándwich, pedidos online, sándwich Barros Luco, Churrasco Italiano" />
    <meta property="og:title" content="Menú de Sándwiches" />
    <meta property="og:description" content="Disfruta de los mejores sándwiches en nuestro menú. ¡Pide ahora!" />
    <meta property="og:image" content="{{ asset('img/logo.png') }}" />
    <meta property="og:url" content="https://www.macastore.online" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#2d3748">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <title>Menú de Sándwich</title>

    <!-- CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-gray-100 text-gray-900 flex flex-col items-center py-10 transition duration-500" id="body">
    <!-- Botón para cambiar entre modo claro y oscuro -->
    <button id="themeToggle"
        class="fixed top-4 right-4 bg-gray-200 text-gray-800 p-2 rounded z-50 transition duration-500"
        aria-label="Cambiar tema">
        <i class="fas fa-moon"></i>
    </button>

    <div class="w-full max-w-7xl mx-auto px-4">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la Empresa" class="h-40 md:h-120" />
        </div>

        <!-- Buscador -->
        <div class="mb-6 relative max-w-md mx-auto">
            <input type="text" id="searchInput" placeholder="Buscar sándwich..."
                class="p-2 pl-10 rounded bg-gray-200 text-gray-800 w-full" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-search text-gray-500"></i>
            </div>
        </div>

        <!-- Contenedor de tarjetas de productos -->
        <div id="productContainer" class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

            <!-- Producto 1: Barros Luco -->
            <div class="sandwich-card bg-white rounded-lg shadow-lg p-4 flex flex-col hover:shadow-2xl transition duration-300"
                data-price="5000" data-name="Barros Luco">
                <img src="{{ asset('img/barrosluco.jpg') }}" alt="Sándwich Barros Luco"
                    class="w-full h-48 md:h-40 lg:h-32 rounded-lg object-cover" loading="lazy" />
                <div class="mt-4 flex-1 flex flex-col">
                    <h2 class="text-lg lg:text-base font-semibold">Barros Luco</h2>
                    <p class="text-sm lg:text-xs text-gray-600 mt-2">Delicioso sándwich de carne y queso fundido.</p>
                    <div class="mt-2">
                        <p class="font-semibold">Agregados:</p>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-barrosluco" data-price="500" data-name="Mayo Casera" />
                            <span class="ml-2 text-sm lg:text-xs">Mayo Casera (+$500)</span>
                        </label>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-barrosluco" data-price="500" data-name="Ajo Cilantro" />
                            <span class="ml-2 text-sm lg:text-xs">Ajo Cilantro (+$500)</span>
                        </label>
                    </div>
                    <div class="mt-2">
                        <span class="total-price text-lg lg:text-base font-bold text-green-600">$5.000</span>
                        <div class="flex items-center mt-2">
                            <button class="minus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Disminuir cantidad">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity mx-2 text-lg lg:text-base">1</span>
                            <button class="plus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Aumentar cantidad">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 lg:py-1 lg:text-sm rounded mt-4 w-full hover:scale-105 transition duration-300" aria-label="Agregar al carrito">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Producto 2: Churrasco Italiano -->
            <div class="sandwich-card bg-white rounded-lg shadow-lg p-4 flex flex-col hover:shadow-2xl transition duration-300"
                data-price="5500" data-name="Churrasco Italiano">
                <img src="{{ asset('img/churrasco-italiano.jpg') }}" alt="Sándwich Churrasco Italiano"
                    class="w-full h-48 md:h-40 lg:h-32 rounded-lg object-cover" loading="lazy" />
                <div class="mt-4 flex-1 flex flex-col">
                    <h2 class="text-lg lg:text-base font-semibold">Churrasco Italiano</h2>
                    <p class="text-sm lg:text-xs text-gray-600 mt-2">
                        Sándwich con carne, palta y tomate.
                    </p>
                    <div class="mt-2">
                        <p class="font-semibold">Agregados:</p>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-churrascoitaliano" data-price="500" data-name="Mayo Casera" />
                            <span class="ml-2 text-sm lg:text-xs">Mayo Casera (+$500)</span>
                        </label>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-churrascoitaliano" data-price="500" data-name="Ajo Cilantro" />
                            <span class="ml-2 text-sm lg:text-xs">Ajo Cilantro (+$500)</span>
                        </label>
                    </div>
                    <div class="mt-2">
                        <span class="total-price text-lg lg:text-base font-bold text-green-600">$5.500</span>
                        <div class="flex items-center mt-2">
                            <button class="minus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Disminuir cantidad">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity mx-2 text-lg lg:text-base">1</span>
                            <button class="plus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Aumentar cantidad">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 lg:py-1 lg:text-sm rounded mt-4 w-full hover:scale-105 transition duration-300" aria-label="Agregar al carrito">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Producto 3: Italiano Pollo -->
            <div class="sandwich-card bg-white rounded-lg shadow-lg p-4 flex flex-col hover:shadow-2xl transition duration-300"
                data-price="5500" data-name="Italiano Pollo">
                <img src="{{ asset('img/italiano-pollo.jpg') }}" alt="Sándwich Italiano Pollo"
                    class="w-full h-48 md:h-40 lg:h-32 rounded-lg object-cover" loading="lazy" />
                <div class="mt-4 flex-1 flex flex-col">
                    <h2 class="text-lg lg:text-base font-semibold">Italiano Pollo</h2>
                    <p class="text-sm lg:text-xs text-gray-600 mt-2">
                        Sándwich con pollo, palta y tomate.
                    </p>
                    <div class="mt-2">
                        <p class="font-semibold">Agregados:</p>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-italianopollo" data-price="500" data-name="Mayo Casera" />
                            <span class="ml-2 text-sm lg:text-xs">Mayo Casera (+$500)</span>
                        </label>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-italianopollo" data-price="500" data-name="Ajo Cilantro" />
                            <span class="ml-2 text-sm lg:text-xs">Ajo Cilantro (+$500)</span>
                        </label>
                    </div>
                    <div class="mt-2">
                        <span class="total-price text-lg lg:text-base font-bold text-green-600">$5.500</span>
                        <div class="flex items-center mt-2">
                            <button class="minus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Disminuir cantidad">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity mx-2 text-lg lg:text-base">1</span>
                            <button class="plus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Aumentar cantidad">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 lg:py-1 lg:text-sm rounded mt-4 w-full hover:scale-105 transition duration-300" aria-label="Agregar al carrito">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Producto 4: Churrasco a lo Pobre -->
            <div class="sandwich-card bg-white rounded-lg shadow-lg p-4 flex flex-col hover:shadow-2xl transition duration-300"
                data-price="6000" data-name="Churrasco a lo Pobre">
                <img src="{{ asset('img/sandpobre.jpg') }}" alt="Sándwich Churrasco a lo Pobre"
                    class="w-full h-48 md:h-40 lg:h-32 rounded-lg object-cover" loading="lazy" />
                <div class="mt-4 flex-1 flex flex-col">
                    <h2 class="text-lg lg:text-base font-semibold">Churrasco a lo Pobre</h2>
                    <p class="text-sm lg:text-xs text-gray-600 mt-2">
                        Sándwich de carne, papas, cebolla y huevo frito.
                    </p>
                    <div class="mt-2">
                        <p class="font-semibold">Agregados:</p>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-churrascopobre" data-price="500" data-name="Mayo Casera" />
                            <span class="ml-2 text-sm lg:text-xs">Mayo Casera (+$500)</span>
                        </label>
                        <label class="flex items-center mt-2">
                            <input type="radio" class="agregado" name="agregado-churrascopobre" data-price="500" data-name="Ajo Cilantro" />
                            <span class="ml-2 text-sm lg:text-xs">Ajo Cilantro (+$500)</span>
                        </label>
                    </div>
                    <div class="mt-2">
                        <span class="total-price text-lg lg:text-base font-bold text-green-600">$6.000</span>
                        <div class="flex items-center mt-2">
                            <button class="minus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Disminuir cantidad">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity mx-2 text-lg lg:text-base">1</span>
                            <button class="plus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Aumentar cantidad">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 lg:py-1 lg:text-sm rounded mt-4 w-full hover:scale-105 transition duration-300" aria-label="Agregar al carrito">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Producto 5: Ave Mayo -->
            <div class="sandwich-card bg-white rounded-lg shadow-lg p-4 flex flex-col hover:shadow-2xl transition duration-300"
                data-price="5000" data-name="Ave Mayo">
                <img src="{{ asset('img/ave-mayo.jpeg') }}" alt="Sándwich Ave Mayo"
                    class="w-full h-48 md:h-40 lg:h-32 rounded-lg object-cover" loading="lazy" />
                <div class="mt-4 flex-1 flex flex-col">
                    <h2 class="text-lg lg:text-base font-semibold">Sándwich Ave Mayo</h2>
                    <p class="text-sm lg:text-xs text-gray-600 mt-2">
                        Sándwich ave mayo con lechuga.
                    </p>
                    <div class="mt-2">
                        <span class="total-price text-lg lg:text-base font-bold text-green-600">$5.000</span>
                        <div class="flex items-center mt-2">
                            <button class="minus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Disminuir cantidad">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity mx-2 text-lg lg:text-base">1</span>
                            <button class="plus-btn bg-gray-200 rounded-full w-8 h-8 lg:w-6 lg:h-6 flex items-center justify-center" aria-label="Aumentar cantidad">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 lg:py-1 lg:text-sm rounded mt-4 w-full hover:scale-105 transition duration-300" aria-label="Agregar al carrito">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

        </div> <!-- Fin de productContainer -->
    </div> <!-- Fin del contenedor principal -->

    <!-- Modal inicial -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="bg-white p-6 rounded shadow-lg">
            <p class="text-lg font-semibold text-center">Pedidos solo hasta el 11-12-2024 / 11am</p>
        </div>
    </div>

    <!-- Carrito de compras -->
    <button id="toggleCart"
        class="fixed bottom-4 right-4 bg-green-600 text-white p-3 rounded-full shadow-lg transition duration-500"
        aria-label="Ver carrito">
        <i class="fas fa-shopping-cart"></i>
        <span id="cartCount"
            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center hidden">
            0
        </span>
    </button>

    <div id="cart" class="hidden bg-white p-4 sm:p-6 rounded-t-lg shadow-lg">
        <h2 class="text-xl font-bold text-center mb-4">Carrito de Compras</h2>
        <div id="cartItems"></div>
        <div class="flex justify-between items-center mt-4">
            <div class="font-bold">Total: <span id="cartTotal">$0</span></div>
            <button id="payButton" class="bg-blue-500 text-white lg:text-sm px-4 py-2 rounded mt-2">
                Solicitar
            </button>
        </div>
    </div>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 class="text-xl font-bold mb-4">Confirmar Pedidos</h2>
            <div class="mb-4">
                <label for="userName" class="block text-gray-700">Tu Nombre y Apellido:</label>
                <input type="text" id="userName" class="w-full p-2 border rounded"
                    placeholder="Ingresa tu nombre y apellidos" required />
            </div>
            <div id="confirmItems" class="mb-4 mt-2"></div>
            <div class="font-bold">Total: <span id="modalTotal">$0</span></div>
            <button id="sendOrder" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
                Enviar Pedido 
            </button>
        </div>
    </div>

    <!-- Script principal -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register("{{ asset('service-worker.js') }}")
            .then(registration => {
            })
            .catch(error => {
                console.error('Error al registrar el Service Worker:', error);
            });
        }

        // Muestra el modal al iniciar y lo oculta luego de 5s
        window.onload = function () {
            const modal = document.getElementById('modal');
            modal.style.display = 'flex';
            setTimeout(function () {
                modal.classList.add('opacity-0');
                setTimeout(function () {
                    modal.style.display = 'none';
                }, 500);
            }, 5000);
        };
    </script>

</body>
</html>
