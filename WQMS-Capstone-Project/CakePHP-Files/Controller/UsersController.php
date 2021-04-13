<!--
This is where the backend databse value posting and accessing takes place.-->

<!--
*************************************************************************
*Title:             Simple Acl controlled Application
*Author:            CakePHP CookBook
*Date Accessed:     January 8, 2021
*Code Version:      2.x
*Availability:      https://book.cakephp.org/2/en/tutorials-and-examples/simple-acl
					-controlled-application/simple-acl-controlled-application.html
*************************************************************************
-->

<?php

class UsersController extends AppController {

	public $helpers = array('Js');
	public $components = array('Auth','RequestHandler');

	public function beforeFilter() {
        $this->layout ='';
        $this->Auth->loginAction = array('controller'=>'users', 'action'=>'login');
        $this->Auth->allow(); 
    }

    public function login() {
    	$this->layout = '';	
	}

	//User login function posting to the databse
    public function user_login(){
    	//session_start();
    	$this->layout = '';	
    	$this->autoRender = false;
    	//Accessing the databse and capturing the value from the users table
    	if (isset($_POST['username'])) {
		  	$response = array();
			$username = $_POST['username'];
			$password = $_POST['password'];
		  	$enc_password = md5($password);
		  	$user_details = $this->User->query("SELECT * FROM users WHERE username='$username' AND password='$enc_password'");
		  	if ($username == $user_details[0]['users']['username']) {

		  	  $response['login_status'] = "Login Success";
		  	}else {
		  		$response['login_status'] = "Login Failed!";
		  	}
		  	echo json_encode($response);
		}
    }

	public function register() {
		
	}

	//User egitration form submit to the database 
	public function user_register(){
		$this->autoRender = false;
        $this->layout = '';		
		if (isset($_POST['username'])) {
			$response = array();
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password_1 = $_POST['password1'];
			$password_2 = $_POST['password2'];
			$username_exist = '';
			$usermail_exist = '';

			//Checking if the user already exists or not, if not register the new user.
			$user_details = $this->User->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
			for ($i = 0; $i < count($user_details); $i++) {
			    $username_exist = $user_details[$i]['users']['username'];
			    $usermail_exist = $user_details[$i]['users']['email'];
			}
			if ($username == $username_exist) { // if user exists
			  	$response['user_status'] = "Username already exists";
			} else if ($email == $usermail_exist) {
		      	$response['user_status'] = "Email already exists";
		    }else {
				$password = md5($password_1);//encrypt the password before saving in the database
				$user = $this->User->query("INSERT INTO users (username, email, password) 
			  			VALUES('$username', '$email', '$password')");
				$response['user_status'] = "You are now registered";
			}
			
			echo json_encode($response);
		}
	}

	public function dashboard() {
    	$this->layout = '';	
	}

	//Posting the dropdown value to the measure flag table so that the arduino can activate the sensor based on the value
	public function measure() {
    	$this->layout = '';	
    	$this->autoRender = false;
    	$response = array();
    	$this->loadModel("MeasureFlag");
    	$this->loadModel("Temperature");
    	$this->loadModel("Turbidity");
    	if (isset($_POST['dataValue'])) {
			$measureFlag = $_POST['dataValue'];
			$flag_details = $this->MeasureFlag->query("UPDATE measure_flags SET Value = '$measureFlag' WHERE ID=1");
		  	$response['updateFlag'] = $measureFlag;
		  	//$response['maxID'] = $maxID;
		  	echo json_encode($response);
		}
	}

	//Updating the table with which value was measured recently
	public function updatetable(){
		$this->layout = '';	
    	$this->autoRender = false;
    	$response = array();
    	$details="";
    	$this->loadModel("Temperature");
    	$this->loadModel("Turbidity");
    	$this->loadModel("DataInsert");
    	$this->loadModel("MeasureFlag");
    	$this->loadModel("Quality");

    	
    	if ( (isset($_POST['dataValue'])) )  {

    		$insertDetails = $this->DataInsert->query("SELECT Value FROM data_inserts WHERE id=1");
    		$insertDetails = $insertDetails[0]['data_inserts']['Value'];

    		$flagDetails = $this->MeasureFlag->query("SELECT Value FROM measure_flags WHERE id=1");
    		$flagDetails = $flagDetails[0]['measure_flags']['Value'];

    		if($flagDetails == "NULL"){
	    		if($insertDetails == "Temperature Values Inserted"){
					$details = $this->Temperature->query("SELECT * FROM temperatures ORDER BY id DESC LIMIT 1");
				}else if($insertDetails == "PH Value Inserted" ){
					$details = $this->Quality->query("SELECT * FROM qualities ORDER BY id DESC LIMIT 1");
				}else if($insertDetails == "Turbidity Value Inserted"){
					$details = $this->Turbidity->query("SELECT * FROM turbidities ORDER BY id DESC LIMIT 1");
				}
			}
    	}
    	$response['flagDetails'] = $flagDetails;
    	$response['insertDetails'] = $insertDetails;
    	$response['tableDetails'] = $details;
		echo json_encode($response);
	}

}

