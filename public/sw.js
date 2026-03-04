const CACHE_NAME = "febrainys-cache-v1";

self.addEventListener("install", (event) => {
    self.skipWaiting();
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        fetch(event.request).catch(() => caches.match(event.request)),
    );
});
