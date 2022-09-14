importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyAX9L8FnLgMF_OdCHBkiJrdvma9Vm25uJ0",
    authDomain: "mygurudwara-16e84.firebaseapp.com",
    projectId: "mygurudwara-16e84",
    messagingSenderId: "274271873270",
    appId: "1:274271873270:web:40af76502e6d139d75a4d7",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});