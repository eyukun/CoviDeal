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
	<link rel="stylesheet" href="css/manageTestKit.css" type="text/css" media="screen">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <title>CoviDeal - The Covid-19 Test Information System</title>
		<!-- javascript source !-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/manageTestKit.js"></script>
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
             <a 
			 <?php if(isset($_SESSION['centreID']) != null){ ?> class="nav-link text-secondary" 
			 href="#" title="You are owning a test centre currently !" <?php }
			else { ?> class="nav-link" href="RegisterTestCentre.php" <?php } ?>
			 >Register Centre</a>
         </li>
		
         <li class="nav-item pill-3">
             <a
			 <?php if(isset($_SESSION['centreID']) == null){ ?> class="nav-link text-secondary"
			 href="#" title="Please register a test centre first !" <?php }
			 else { ?> class="nav-link active" href="RecordTester.php" <?php } ?>
			 >Record Tester</a>
         </li>
		 <li class="nav-item pill-4">
             <a
			 <?php if(isset($_SESSION['centreID']) == null){ ?> class="nav-link text-secondary"
			 href="#" title="Please register a test centre first !" <?php } 
			 else { ?> class="nav-link " href="ManageTestKit.php" <?php } ?>
			 >Manage Test Kit Stock</a>
         </li>
 	   </ul>
 			
		<ul class="navbar-nav mr-auto">
       </ul>
       <a class="navbar-brand" href="index.php" style="font-family:cursive; color: white;"><i class="fa fa-sign-out"></i>Sign out</a>
      
 	</div>
   </nav>
   
	<nav>
		<br>
		<div class="container">
		<h1 class="title">Record Tester</h1><br><br>
		 <!--form to add new tester!-->
		<form action="common.php" method="post">
			<div>
				<div>
					<div>
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Add a New Tester</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-lg-12">
									<?php
									if (isset($_SESSION['error'])) {
										echo $_SESSION['error'];
										unset($_SESSION['error']);} ?>
								</div>
							</div>
							<div class="form-group row">
								<!-- <div id="error"> -->
								<label for="username"class="col-sm-6 col-lg-12 col-form-label"> Username</label>
								<div class="col-sm-12 col-lg-8">
									<input type="text" class="form-control" name="username"  pattern="[a-zA-Z ]+" maxlength = "20"
									placeholder="Username" title="Please enter a username contains only letters." required>
									<div class="invalid-feedback">Please enter the Username.</div><br>
								</div>

								<label for="password" class="col-sm-6 col-lg-12 col-form-label"> Password</label>
								<div class="col-sm-12 col-lg-8">
									<input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
									minlength="8"
									maxlength = "20"
									placeholder="Password" title="Please enter a password contains at least one number and one letter, and at least 8 or more characters." required>
									<div class="invalid-feedback">Please enter the Password.</div><br>
								</div>


								<label for="name"class="col-sm-6 col-lg-12 col-form-label"> Name</label>
								<div class="col-sm-12 col-lg-8">
									<input type="text" class="form-control" name="name"  pattern="[a-zA-Z ]+"
									maxlength = "50"
									placeholder="Full Name" title="Please enter a name contains only letters." required>
									<div class="invalid-feedback">Please enter the Name.</div><br>
								</div>
							</div>
						</div>
						
						 <!--go to common.php to record new tester!-->
						<div class="modal-footer">
							<input name="action_name" value ="record_tester" hidden>
							<input type="submit" class="btn btn-primary" name="submit" value="Add" >
						</div>
					</div>
				</div>
			</div>
		</form>
		<br><br><br><br><br><br><br><br><br><br>
		</div>

		
		
	</nav>
	
	
	
	
	<!-- footer !-->
	  <!-- Site footer -->
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
</footer>
	
</body>
</html>
<!--
Student Name: Ng Jun Zhi
Student ID: B1802197
!-->