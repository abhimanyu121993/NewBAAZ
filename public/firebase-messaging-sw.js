importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
  
    // apiKey:"AIzaSyC5FU8uuVi0-44JDcWZwADB-jOLR5bviJg",
    authDomain: "baazapp-9d05b.firebaseapp.com",
    projectId: "baazapp-9d05b",
    messagingSenderId: "317918604459",
    appId: "1:317918604459:android:48d05054d4661d6ff7dbee",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({ data: { title, body, icon,image,sound} }) {
    return self.registration.showNotification(title, { body, icon,image,sound });
});