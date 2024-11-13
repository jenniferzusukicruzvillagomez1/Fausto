const CACHE_NAME = 'Tienda_Online';
const urlsToCache = [
    '/',
    '/php/index.php',
    '/php/bienvenido.php',
    '/php/registro_usuario_be.php',
    '/php/login_usuario_be.php',
    '/php/conexion_be.php',
    '/php/cerrar_sesion.php',
    '/css/styles.css',
    '/manifest.json',
    '/images/fondo1.jpg',
    '/images/tendedero.png',
    '/js/sript.js'
];
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Cache abierto');
                return cache.addAll(urlsToCache);
            })
    );
});
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
              
                if (response) {
                    return response;
                }
                
                return fetch(event.request)
                    .then(response => {
                        
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                       
                        const responseToCache = response.clone();

                      
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });

                        return response;
                    });
            })
    );
});