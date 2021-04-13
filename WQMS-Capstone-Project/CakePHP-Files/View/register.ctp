<!--User Registration page created using basic HTML-->

<!--
*************************************************************************
*Title:             How To - Register Form
*Author:            W3Schools / Open Source License
*Date Accessed:     January 8, 2021
*Code Version:      -
*Availability:      https://www.w3schools.com/howto/howto_css_register_form.asp
*************************************************************************
-->

<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <link rel="stylesheet" type="text/css" href="app/webroot/css/basic.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" id = "user_name" placeholder="Enter Username" >
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" id = "user_email" placholder="Enter Email" >
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" id = "user_pass" placeholder="Enter Password" >
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" id = "user_confirm_pass" placeholder="Confirm Password" >
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" id="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login" >Sign in</a>
  	</p>
  </form>
</body>
</html>

<script type="text/javascript">
//On register user button click, the values are posted to databse using AJAX post method.
$("#reg_user").click(function(e){
  e.preventDefault();
  var username = $("#user_name").val();
  var email = $("#user_email").val();
  var password_1 = $("#user_pass").val();
  var password_2 = $("#user_confirm_pass").val();

  //Checking for empty fields before submission
  if ( (username != '')&&(email != '')&&(password_1 != '')&&(password_2 != '') ){
    if(password_1 == password_2){
       $.ajax({  
            type: 'POST',
            url: 'users/user_register',
            cache: false,
            data: {
             'username': username,
             'email': email,
             'password1': password_1,
             'password2' : password_2
           },
           dataType: 'Json',
           success: function(data) {
            alert("Registration Success");
            location.href = 'login';
           },      
           error: function (textStatus, errorThrown ) {
            console.log("error test");
           }
       });
    }else{
      alert("Passwords should match!");
    }
  }else{
    alert("Please fill in all the fields!")
  }
});

//If already registered user, they can sign in
$("#signin").click(function(e){
  e.preventDefault();
  $.ajax({  
            type: 'POST',
            url: 'users/register_test',
            cache: false,
            data: {
             'username': username,
             'email': email
             
           },
           dataType: 'json',
           success: function(data) {
            alert(data.status);
           },      
           error: function (textStatus, errorThrown ) {
            //console.log(textStatus);
           }
       });
});
</script>


