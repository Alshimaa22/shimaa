<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="888838140421-6sj3fv9hhp6gv9ef8tvbvvf68jsbuq8o.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        var s=profile.getName();
        var h= profile.getGivenName();
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
       var e= profile.getEmail();
        // The ID token you need to pass to your backend:
		  location.replace("http://tafl.azharlink.com/login/log.php?Name="+s);

        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
		 
      }
    </script>

<div id="demo"></div>

  </body>
</html>