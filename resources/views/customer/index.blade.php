<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開店好評網</title>

    <!--Load Firebase Must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-analytics.js"></script>

    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-messaging.js"></script>
    <script>
    var firebaseConfig = {
        apiKey: "AIzaSyDX14g8FYzfjnAc1jkLF13GL5kAEL2CmfM",
        authDomain: "ecommerce-315dd.firebaseapp.com",
        projectId: "ecommerce-315dd",
        storageBucket: "ecommerce-315dd.appspot.com",
        messagingSenderId: "708535413064",
        appId: "1:708535413064:web:de57944f50949db93c6b7d",
        measurementId: "G-EB7744DFDD"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    window.messaging = firebase.messaging() ;
    messaging.usePublicVapidKey('BK47gmnR_m0t8EIi-JTqrRYUkgY7wbTpnWbyVyVXWxNqV4RmP_AeCe4c8RjYJJ3_xEZqyL5CuHOmrfoi7FiAGzQ');
    </script>
    <!--Firebase End-->

</head>
<body>
    <h2>Customer Home</h2>    
    <a onclick="getUserDevice()">訂閱</a>
    <a onclick="deleteToken()">取消訂閱</a>
<!--Start Global Script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--End Global Script-->

<script>
 $(document).ready(function(){

    if('serviceWorker' in navigator) { 
          navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then(async function(registration) {
                messaging.useServiceWorker(registration);
                await Notification.requestPermission();
            }); 
    };

    messaging.onMessage(function(payload){
        let { title:msgTitle }= payload.data ;
        let notification = new Notification(msgTitle, payload.data);
    });
 });

 function deleteToken(){
    messaging.deleteToken();
 };

 async function getUserDevice(){
    messaging.requestPermission();
    let token = await messaging.getToken();
    console.log(token);
 }
</script>

</body>
</html>