<!--Login Page created using basic HTML-->

<!--
*************************************************************************
*Title:             How To - Login Form
*Author:            W3Schools / Open Source License
*Date Accessed:     January 8, 2021
*Code Version:      -
*Availability:      https://www.w3schools.com/howto/howto_css_login_form.asp
*************************************************************************
-->



<!DOCTYPE html>
<html>
<head>
  <title>User Authentication</title>
    <link rel="stylesheet" type="text/css" href="app/webroot/css/basic.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" id="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" id="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" id="login_user">Login</button>
  	</div>
  	<p>
  		Not yet registered? <a href="register">Sign up</a>
  	</p>
  </form>
</body>
</html>


<script type="text/javascript">
//User Button Click used to submit the login information
$("#login_user").click(function(e){
  e.preventDefault();

  var username = $("#username").val();
  var password = $("#password").val();

  if ( (username != '')&&(password != '') ){
    $.ajax({  
        type: 'POST',
        url: 'users/user_login',
        cache: false,
        data: {
         'username': username,
         'password': password
         
       },
       dataType: 'json',
       success: function(data) {
        alert(data.login_status);
        location.href = 'dashboard';
       },      
       error: function (textStatus, errorThrown ) {
        //console.log(textStatus);
       }
   });
  } else{
    alert("Please fill in all the fields!")
  }
});
</script>