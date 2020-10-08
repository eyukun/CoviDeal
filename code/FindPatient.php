<!--
Student Name: Ng Jun Zhi
Student ID: B1802197
!-->
<?php require_once('common.php')?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <!--link for boostrap!-->
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/FindPatient.css" type="text/css" media="screen">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <title>CoviDeal - The Covid-19 Test Information System</title>
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/manageTestKit.js"></script>
	 <!--java script!-->
	<script>
		function searchPatient() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("filter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("patientTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			  txtValue = td.textContent || td.innerText;
			  if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
	</script>
  </head>

 <body>
   <!--navigation-->
 	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			<span class="navbar-toggler-icon"></span>
		</button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="nav nav-pills" role="tablist">
			 <li class="nav-item pill-1">
				<a class="navbar-brand" style="font-family:cursive; color: white;">CoviDeal</a>
			 </li>
         <li class="nav-item pill-2">
             <a class="nav-link active" href="FindPatient.php" style ="color:white">Record New Test</a>
         </li>
		
         <li class="nav-item pill-3">
             <a class="nav-link" href="UpdateTestResult.php"> Update Test Result</a>
         </li>
 	   </ul>
 			
		<ul class="navbar-nav mr-auto">
       </ul>
       <a class="navbar-brand" href="index.php" style="font-family:cursive; color: white;"><i class="fa fa-sign-out"></i>Sign out</a>
      
 	</div>
   </nav>
   
	
   <!-- Body !-->
   <!-- container !-->
  <div class = "container" id = "box">
	<div>
	  <h1 class="display-4">Record New Test</h1>
	  <hr class="my-4">
	  <p style="font-size:20px;"> Manage or Register for a Patient</p><br>
	</div>	
	<hr>
	 <div class="row align-items-center">
		<div class="mx-auto">
			 <form class="form-inline">
				<i class="fa fa-search" aria-hidden="true" 
				style="margin-right: 6px;"></i>
			   <input class="form-control" id="filter" type="number" min="1"
			   placeholder="Search by PatientID" onkeyup="searchPatient()">
			 </form>	
		 </div>
	 </div>
	 </hr>
	<div class="form-group">
	 <!--error message!-->
		<div class="col-lg-12">
			<?php
			if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);} ?>
		</div>
	</div>
	
	<!-- display the list of test kit !-->
	<?php
	//connect to mysql
		$conn = new mysqli("localhost","root","", "covideal");
		if ($conn->connect_error){
			die("Connection failure: " . mysqli_connect_error());
		}
		
		//use table
		$userTable = "use user";
		$conn->query($userTable);
	    $sql = "SELECT * FROM user where position='patient'";
		
		//testkit table
		$check = new mysqli("localhost","root","", "covideal");
		if ($check->connect_error){
			die("Connection failure: " . mysqli_connect_error());
		}
		
		$testkitTable="use testkit";
		$check->query($testkitTable);
		$test="SELECT kitid,testname FROM testkit where availableStock > 0 AND centreID='".$_SESSION['centreID']."'";
		
		//fetch the data into while loop
		$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
		$resultset1 = mysqli_query($check, $test) or die("database error:". mysqli_error($check));
		
		$testkit_row = array();
		while($col = mysqli_fetch_assoc($resultset1)){
			$testkit_row[$col['kitid']] = $col['testname'];
		}
		
		
		//if material table dont have data, display the message
		if (mysqli_num_rows($resultset) == 0) { ?>
			<h3>There are no Patient currently, please add one!</h3>
		<?php //if have materials
		} else {
		?>
		<h3>Patient Table</h3>
		<!-- list of all patient !-->
		<table class="table table-borderless" id="patientTable">
			  <thead>
				<tr class="thead-dark">
				  <th class="text-center">UserID</th>
				  <th class="text-center">Username</th>
				  <th class="text-center">Name</th>
				  <th class="text-center">PatientType</th>
				  <th class="text-center">Symptoms</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
			   <!--table for patient details!-->
			  <?php
			  while($row = mysqli_fetch_array($resultset)):
			  ?>
				<tr>
				  <td align="center"><?php echo $row['id'];?></td>
				  <td align="center"><?php echo $row['username'];?></td>
				  <td align="center"><?php echo $row['name'];?></td>
				  <td align="center"><?php echo $row['patientType'];?></td>
				  <td align="center"><?php echo $row['symptoms'];?></td>
				  <td align="middle">
				  <button type="button" id="update" value="update" data-toggle="modal" 
				  data-target="#updatePatientModal<?php echo $row['id'];?>" 
				  class="btn btn-primary"> Update </button>
				  </td>
				</tr>				
			  
				<!-- Update Test Kit Stock Modal !-->
				<form action="common.php" method="POST" class="needs-validation" novalidate>
					<div class="modal fade" id="updatePatientModal<?php echo $row['id'];?>"
					tabindex="-1" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Update Patient & Record New Test</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group row">
										<label for="id" class="col-sm-6 col-lg-4 col-form-label"> UserID </label>
										<div class="col-sm-12 col-lg-8">
											<input type="text" class="form-control" name="id" value="<?php echo $row['id'];?>" readonly><br>
										</div>
									
										<label for="username" class="col-sm-6 col-lg-4 col-form-label"> Username </label>
										<div class="col-sm-12 col-lg-8">
											<input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" readonly><br>
										</div>
										
										<label for="patientType" class="col-sm-6 col-lg-4 col-form-label"> PatientType </label>
										<div class="col-sm-12 col-lg-8">
										<select name="patientType" id="patientType" class="form-control" >
												<option value="Returnee">Returnee</option>
												<option value="Quarantined">Quarantined</option>
												<option value="Close Contact">CloseContact</option>
												<option value="Infected">Infected</option>
												<option value="Suspected">Suspected</option>
											</select><br>
										</div>
										<label for="symptoms" class="col-sm-6 col-lg-4 col-form-label">Symptoms</label>
										<div class="col-sm-12 col-lg-8">
											<input type="text" class="form-control" name="symptoms"
											maxlength = "50" pattern="[a-zA-Z ]+"
											placeholder="Symptoms of the Patient" required>
											<div class="invalid-feedback">Please enter the Symptoms.</div><br>
										</div>
										
										<label for="kitID"class="col-sm-6 col-lg-4 col-form-label">KITID</label>
										<div class="col-sm-12 col-lg-8">
											
											<select name="kitID" class="form-control" >
												<?php
												
													foreach($testkit_row  as $i => $v) :
												?>
												<option value="<?php echo $i ?>"><?php echo $i.":  ".$v;?></option>
												<?php endforeach ?>
											</select>
										</div>
										
									</div>
								</div>
								<div class="modal-footer">
								 <!--submit and go to common.php!-->
									<input name="action_name" value="updatePatient" hidden>
									<input type="submit" class="btn btn-primary" name="submit" value="Update">
								</div>
							</div>
						</div>
					</div>
				</form>
			  <?php endwhile;?>
			</tbody>
		</table>
		<?php } ?>
			<br><br>
			<div>
			 <!--button for register new patient!-->
				  <button id="btn1" type="button" class="btn btn-success" data-toggle="modal"
				  data-target="#recordPatientModal"> Register </button>
			</div>
			<br>
	   </div>  
		<br><br>
		
		
		
		<!-- RecordPatient Modal !-->
			<form action="common.php" method="POST" class="needs-validation" novalidate>
				<div class="modal fade" id="recordPatientModal" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Record Patient & Record New Test</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row">
									<label for="username"class="col-sm-6 col-lg-4 col-form-label"> Username</label>
									<div class="col-sm-12 col-lg-8">
									<input type="text" class="form-control" name="username"  pattern="[a-zA-Z ]+" maxlength = "20"
									placeholder="Username" required>
									<div class="invalid-feedback">Please enter the Username.</div><br>
								</div>

								<label for="password" class="col-sm-6 col-lg-4 col-form-label"> Password</label>
								<div class="col-sm-12 col-lg-8">
									<input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
									minlength="8"
									maxlength = "20"
									placeholder="Password" required>
									<div class="invalid-feedback">Please enter the Password.</div><br>
								</div>


								<label for="name"class="col-sm-6 col-lg-4 col-form-label"> Name</label>
								<div class="col-sm-12 col-lg-8">
									<input type="text" class="form-control" name="name" pattern="[a-zA-Z ]+"
									maxlength = "50"
									placeholder="Full Name" required>
									<div class="invalid-feedback">Please enter the Name.</div><br>
								</div>
								
								<label for="type"class="col-sm-6 col-lg-4 col-form-label">Patient Type</label>
								<div class="col-sm-12 col-lg-8">
								<select name="patientType" id="patientType" class="form-control">
									<option value="Returnee">Returnee</option>
									<option value="Quarantine">Quarantine</option>
									<option value="Close Contact">Close Contact</option>
									<option value="Infected">Infected</option>
									<option value="Suspected">Suspected</option>
									
								</select>
								<br>
								</div>
								<label for="symptoms"class="col-sm-6 col-lg-4 col-form-label">Symptoms</label>
								<div class="col-sm-12 col-lg-8">
									<input type="text" class="form-control" name="symptoms"
									maxlength = "50"
									placeholder="Symptoms of the Patient" required>
									<div class="invalid-feedback">Please enter the Symptoms.</div><br>
								</div>
								
								<label for="kitID"class="col-sm-6 col-lg-4 col-form-label">KITID</label>
										<div class="col-sm-12 col-lg-8">
											
											<select name="kitID" class="form-control" >
												<?php
												
													foreach($testkit_row  as $i => $v) :
												?>
												<option value="<?php echo $i ?>"><?php echo $i.":   ".$v;?></option>
												<?php endforeach ?>
											</select>
										</div>
								</div>
							</div>
							 <!--go to common.php!-->
							<div class="modal-footer">
								<input name="action_name" value="recordPatient" hidden>
								<input type="submit" class="btn btn-primary" name="submit" value="Register">
							</div>
						</div>
					</div>
				</div>
			</form>
		
   <!-- footer !-->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="button" target="_blank" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
              <li><a class="button" target="_blank" href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
              <li><a class="button" target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
			  <li><a class="button" target="_blank" href="https://www.outlook.com"><i class="fa fa-envelope"></i></a></li>			  
            </ul>
          </div>
        </div>
      </div>
	</footer>
	
</body>
</html>
<!--
Student Name: Ng Jun Zhi
Student ID: B1802197
!-->