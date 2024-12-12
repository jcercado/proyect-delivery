const CACHE_NAME = 'sandwich-menu-v2';
const urlsToCache = [
    './',
    './css/style.css',
    './js/script.js',
    './img/logo.png',
    './img/barrosluco.jpg',
    './img/churrasco-italiano.jpg',
    './img/sandpobre.jpg',
    './img/Sandwich-pollo.jpg'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(urlsToCache);
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request).catch(() => caches.match(event.request))
    );
});

self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) =>
            Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        return caches.delete(cacheName);
                    }
                })
            )
        )
    );
});