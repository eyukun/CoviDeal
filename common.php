<?php
session_start();
// echo "Good Connection!<br>";

// $k = "";
// foreach ($_POST as $key => $value) {
//    $k .= $key ." : ". $value. '\n';
// }
// if($k != ""){
// 	echo '<script> console.info("Session: \n' . $k . '") </script>';
// }


if(isset($_SESSION['user_name'])){
	echo "Welcome " . $_SESSION['user_name'] ;
}

// To decide which function
if(isset($_POST['action_name'])) {
	if (isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
	
	// determine which form
	switch ($_POST['action_name']) {
		
		// login form
		case 'login':
			login();
			break;
		
		case 'registerTestCentre':
			registerTestCentre();
			break;
			
		case 'updateTestKit':
			updateTestKit();
			break;
			
		case 'registerTestKit':
			registerTestKit();
			break;
			
		default:
			# code...
			break;
	}

  	
}

// login function
function login() {

	$sql = "SELECT * FROM user where username = '" . $_POST['username'] . "' and password = '" . $_POST['password'] . "'";
    $user = db_find($sql);
		
    if($user != null){ //authentication success, save in session

		$_SESSION['id']     = $user->id;
		$_SESSION['username']    = $user->username;
		$_SESSION['user_name']   = $user->name;
		$_SESSION['position'] = $user->position;
		$_SESSION['patient_type'] = $user->patientType;
		$_SESSION['centreID'] = $user->centreID;

		switch ($_SESSION['position']) {
			case 'tester': //tester
    			echo "<script> window.location.assign('FindPatient.php'); </script>";
				break;
			case 'manager': //manager
				if ($_SESSION['centreID'] == null){
					echo "<script> window.location.assign('RegisterTestCentre.php'); </script>";
				}
				else {
					echo "<script> window.location.assign('RecordTester.php'); </script>";
				}
				break;
			case 'officer': //officer
				echo "<script> window.location.assign('GenerateTestReport.php'); </script>";
				break;
			case 'null': //patient
				if ($_SESSION['patient_type'] != null){
					echo "<script> window.location.assign('ViewTestingHistory.php'); </script>";
				}
				break;
			default:
				$error = '<div class="alert alert-danger alert-dismissible fade show">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> User\'s position not valid. Please contact system admin.</strong></div>';
				$_SESSION['error'] = $error;
    			echo "<script> window.location.assign('login.php'); </script>";
				break;
		}


    }else{ //fail to login
    	
		$error = '<div class="alert alert-danger alert-dismissible fade show">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>"Wrong Username or Password".</strong></div>';
		$_SESSION['error'] = $error;

    	echo "<script> window.location.assign('login.php'); </script>";
    }
	
}

// for select an object
function db_find($sql){

	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "covideal";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$result = $conn->query($sql);

	return $result->fetch_object();
}

// for insert, update an existing object
function db_result($sql){
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "covideal";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$result = $conn->query($sql);
	return $result;
}

// register test centre function
function registerTestCentre(){

	//get the data from registerTestCentre.php
	//prevent database error due to user's input
	$centreName = $_POST['centreName'];
	$sql = "SELECT * FROM testcentre WHERE centreName='$centreName'";
	$id = $_SESSION["id"];
	$centre = db_find($sql);


	// if have result for this test centre
	if($centre != null)
	{
		$error = '<div class="alert alert-danger alert-dismissible fade show">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Cannot add! ' . $centreName . ' (Test Centre) has already existed.</strong></div>';
		$_SESSION['error'] = $error;
		echo "<script type='text/javascript'> window.location = '/code/registerTestCentre.php'; </script>";
	}
	else{
		// if have registered test centre for this manager (this condition generally will not happen)
		if ($_SESSION['centreID'] != null){
			$error = '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> You are owning a test centre currently ! </strong></div>';
				$_SESSION['error'] = $error;
			echo "<script type='text/javascript'> window.location = '/code/RecordTester.php'; </script>";
		}
		else {
			//add the test centre
			$insert = "insert into testcentre(centreName, id) values ('$centreName', '$id');";
			$centre = db_result($insert);
			if ($centre == true){
				$sql1 = "SELECT * FROM testcentre WHERE centreName='$centreName'";
				$centre = db_find($sql1);
				$centreID = $centre->centreID;
				
				$sql1 = "UPDATE user SET centreID='$centreID' WHERE id='$id'";
				$user = db_result($sql1);
				if ($user != null)	{
					$error = '<div class="alert alert-success alert-dismissible fade show">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>New test centre has been added successfully!</strong></div>';
					$_SESSION['error'] = $error;
					$_SESSION['centreID'] = $centreID;
					echo "<script type='text/javascript'> window.location = '/code/registerTestCentre.php'; </script>";
				}
			}
			else {
				$error = '<div class="alert alert-danger alert-dismissible fade show">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> Test Centre added unsuccessfully!</strong></div>';
				$_SESSION['error'] = $error;
				echo "<script type='text/javascript'> window.location = '/code/registerTestCentre.php'; </script>";
			}
		}
	}
}

// update test kit stock function
function updateTestKit(){
	
	$kitID = $_POST['kitID'];
	$sql = "SELECT * FROM testkit WHERE kitID='$kitID' AND centreID='".$_SESSION['centreID']."'" ;
	$testkit = db_find($sql);
	
	if($testkit == null)
	{
		$error = '<div class="alert alert-danger alert-dismissible fade show">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Error occurs! ' . $kitID . ' (Test Kit) is not found.</strong></div>';
		$_SESSION['error'] = $error;
		echo "<script type='text/javascript'> window.location = '/code/ManageTestKit.php'; </script>";
	}
	else {
		$availableStock = $testkit->availableStock;
		$updatedStock = $_POST['stock'] + $availableStock;
		$update = "UPDATE testkit SET availableStock='$updatedStock' WHERE kitID='$kitID' 
		AND centreID='".$_SESSION['centreID']."'";
		$testkit = db_result($update);
		if ($testkit != null){
			$error = '<div class="alert alert-success alert-dismissible fade show">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Test Kit Stock has been updated successfully!</strong></div>';
			$_SESSION['error'] = $error;
			echo "<script type='text/javascript'> window.location = '/code/ManageTestKit.php'; </script>";											
		}
		else {
			$error = '<div class="alert alert-danger alert-dismissible fade show">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong> Test Centre updated unsuccessfully!</strong></div>';
			$_SESSION['error'] = $error;
			echo "<script type='text/javascript'> window.location = '/code/ManageTestKit.php'; </script>";
		}
	}
}

function registerTestKit(){

	$testName = $_POST['testName'];
	$availableStock = $_POST['stock'];
	$centreID = $_SESSION["centreID"];
	$sql = "SELECT * FROM testkit WHERE testName='$testName' AND centreID='$centreID'";
	$testkit = db_find($sql);


	// if have result for this test kit
	if($testkit != null)
	{
		$error = '<div class="alert alert-danger alert-dismissible fade show">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Cannot add! ' . $testName . ' (Test Kit) has already existed.</strong></div>';
		$_SESSION['error'] = $error;
		echo "<script type='text/javascript'> window.location = '/code/manageTestKit.php'; </script>";
	}
	else{
		//add the test kit
		$insert = "insert into testkit(testName, availableStock, centreID) values ('$testName', '$availableStock', '$centreID');";
		$testkit = db_result($insert);
		if ($testkit == true){
				$error = '<div class="alert alert-success alert-dismissible fade show">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>New test kit has been added successfully!</strong></div>';
				$_SESSION['error'] = $error;
				echo "<script type='text/javascript'> window.location = '/code/manageTestKit.php'; </script>";
		}
		else {
			$error = '<div class="alert alert-danger alert-dismissible fade show">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong> Test Kit added unsuccessfully!</strong></div>';
			$_SESSION['error'] = $error;
			echo "<script type='text/javascript'> window.location = '/code/manageTestKit.php'; </script>";
		}
	}
}
?>