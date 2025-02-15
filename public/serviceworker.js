
// self.addEventListener('install', (event) => {
//     event.waitUntil(
//         caches.open('tadween-cache-v1').then((cache) => {
//             return cache.addAll([
//                 '/offline.html',  // صفحة عدم الاتصال
//                 '/css/style.css',  // ملف الـ CSS المحلي
//                 '/img/logo.webp',  // الأيقونة
//                 '/manifest.json',  // ملف PWA
//                 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
//                 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',

//                 '/js/home.js?version=1.0',

//                 '/js/messages/chat.js?version=1.0',
//                 '/js/messages/display_messages.js?version=1.0',

//                 '/js/notifications/display_notifications.js?version=1.0',

//                 '/js/posts/create_post.js?version=1.0',
//                 '/js/posts/create_reply_post.js?version=1.0',
//                 '/js/posts/create_vote_poll.js?version=1.0',
//                 '/js/posts/delete_post.js?version=1.0',
//                 '/js/posts/display_posts.js?version=1.0',
//                 '/js/posts/display_replies_post.js?version=1.0',
//                 '/js/posts/post_like.js?version=1.0',

//                 '/js/users/display_followers.js?version=1.0',
//                 '/js/users/follow_user.js?version=1.0',
//                 '/js/users/update_user_data.js?version=1.0',

//                 'https://code.jquery.com/jquery-3.6.0.min.js',
//                 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'
            
//             ]);
//         })
        
//     );
// });

// self.addEventListener('fetch', (event) => {
//     const url = new URL(event.request.url);

//     // Exclude authentication requests from caching
//     if (
//         url.pathname.startsWith('/login') || 
//         url.pathname.startsWith('/logout') || 
//         url.pathname.startsWith('/register') ||
//         url.pathname.startsWith('/password') ||  // If using password reset
//         url.pathname.startsWith('/sanctum/csrf-cookie')  // If using Laravel Sanctum
//     ) {
//         return; // Bypass service worker caching
//     }
    
//     event.respondWith(
//         caches.match(event.request).then((response) => {
//             // إذا كان الملف موجودًا في الـ cache
//             if (response) {
//                 return response;
//             }

//             // إذا لم يكن في الـ cache، نقوم بجلبه من الشبكة
//             return fetch(event.request).then((networkResponse) => {
//                 return caches.open('tadween-cache-v1').then((cache) => {
//                     // تخزين الصفحة التي تم تحميلها في الـ cache
//                     cache.put(event.request, networkResponse.clone());
//                     return networkResponse;
//                 });
//             });
//         }).catch(() => caches.match('/offline.html'))
//     );
// });

// self.addEventListener('activate', (event) => {
//     const cacheWhitelist = ['tadween-cache-v1']; // النسخة الحالية من الـ cache
//     event.waitUntil(
//         caches.keys().then((cacheNames) => {
//             return Promise.all(
//                 cacheNames.map((cacheName) => {
//                     if (!cacheWhitelist.includes(cacheName)) {
//                         return caches.delete(cacheName); // حذف الـ cache القديمة
//                     }
//                 })
//             );
//         })
//     );
// });
