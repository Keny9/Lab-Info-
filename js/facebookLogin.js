
window.fbAsyncInit = function() {
  FB.init({
    appId      : '511524552961112',
    cookie     : true,
    xfbml      : true,
    version    : 'v4.0'
  });

  FB.AppEvents.logPageView();

  FB.getLoginStatus(function(response) {
     statusChangeCallback(response);
 });

};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

 function logout(){
		FB.logout();
    window.location.href = "../page/login.php";
	}

 function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }

  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }

  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,email,name', function(response) {
      $.ajax({
       url: '../phpscript/verifyFacebookLogin.php', //This is the current doc
       type: "POST",
       dataType:'json', // add json datatype to get json
       data: ({name: response.name, email: response.email, id: response.id}),
       success: function(data){
       console.log(data);
       window.location.href = "profil.php";
     },
     error: function(data){
       console.log("Error");
       console.log(data);
     }
     });
      console.log('Successful login for: ' + response.name + " " + response.email);
      document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
  }
