importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDE6hJnUlCwrsItIwGzgANXEadx6ITNNlo",
    authDomain: "baazapp-9d05b.firebaseapp.com",
    projectId: "baazapp-9d05b",
    messagingSenderId: "317918604459",
    appId: "1:317918604459:android:7a768864d755f25bf7dbee",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({ data: { title, body, icon,image } }) {
    return self.registration.showNotification(title, { body, icon,image });
});