importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBvs4xSVYAbWaCKmUZRL2aFjUJ4nRjK5AA",
    projectId: "push-notifications-54f0c",
    messagingSenderId: "439482608695",
    appId: "1:439482608695:web:a0f70f088932ee0b86a3b2"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
