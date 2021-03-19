importScripts("https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.5/firebase-messaging.js');

workbox.clientsClaim();
workbox.skipWaiting();

workbox.precaching.precacheAndRoute([
  // 要快取的檔案
]);

// firebase config
var config = {
    apiKey: "AIzaSyDX14g8FYzfjnAc1jkLF13GL5kAEL2CmfM",
    authDomain: "ecommerce-315dd.firebaseapp.com",
    projectId: "ecommerce-315dd",
    storageBucket: "ecommerce-315dd.appspot.com",
    messagingSenderId: "708535413064",
    appId: "1:708535413064:web:de57944f50949db93c6b7d",
    measurementId: "G-EB7744DFDD"
};
firebase.initializeApp(config);

var messaging = firebase.messaging();

// 監聽notifiction點擊事件
self.addEventListener('notificationclick', function(event) {
  var url = click_action;
  event.notification.close();
  event.waitUntil(
    clients.matchAll({
      type: 'window'
    }).then(windowClients => {
      // 如果tab是開著的，就 focus 這個tab
      for (var i = 0; i < windowClients.length; i++) {
        var client = windowClients[i];
        if(client.url === url && 'focus' in client) {
          return client.focus();
        }
      }
      // 如果沒有，就新增tab
      if(clients.openWindow) {
        return clients.openWindow(click_action);
      }
    })
  );
});

// FCM
messaging.setBackgroundMessageHandler(function(payload) {
  let { title , ...options } = payload.data ;
  click_action = data.click_action;
  return self.registration.showNotification(title, options);
});

