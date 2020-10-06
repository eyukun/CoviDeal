<?php require_once('common.php')?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/recordTester.css" type="text/css" media="screen">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <title>CoviDeal - The Covid-19 Test Information System</title>
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/manageTestKit.js"></script>
	<script>
		function searchTest() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("filter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("testTable");
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
             <a 
			 <?php if(isset($_SESSION['testID']) == null){ ?> href="#" title="Please register a Test First!" 
			 class="nav-link text-secondary"
			 <?php }
			 else { ?> class="nav-link" href="FindTest.php" <?php } ?>
			 > Update Test Result</a>
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
	  <h1 class="display-4">View Test</h1>
	  <hr class="my-4">
	</div>	
	<hr>
	 <div class="row align-items-center">
		
	 </div>
	 </hr>
	
	<!-- display the list of test kit !-->
	<?php
	//connect to mysql
		$conn = new mysqli("localhost","root","", "covideal");
		if ($conn->connect_error){
			die("Connection failure: " . mysqli_connect_error());
		}
				
		//use table
		$testID = $_GET['test_id'];
		$testTable = "test";
		$conn->query($testTable);
	    $sql = "SELECT * FROM test where testID='$testID'";
	    $result = mysqli_query($conn, $sql);
		
		//fetch the data into while loop
		$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
		
		?>
		<h5>Test Table</h5>
		<form action="FindPatient.php">
		<!-- list of all patient !-->
		<table class="table table-borderless" id="testTable">
			  <thead>
				<tr class="thead-dark">
				  <th class="text-center">TestID</th>
				  <th class="text-center">TestDate</th>
				  <th class="text-center">Result</th>
				  <th class="text-center">ResultDate</th>
				  <th class="text-center">Status</th>
				  <th class="text-center">PatientID</th>
				  <th class="text-center">Kit ID</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			  while($row = mysqli_fetch_array($resultset)):
			  ?>
				<tr>
				  <td align="center"><?php echo $row['testID'];?></td>
				  <td align="center"><?php echo $row['testDate'];?></td>
				  <td align="center"><?php echo $row['result'];?></td>
				  <td align="center"><?php echo $row['resultDate'];?></td>
				  <td align="center"><?php echo $row['status'];?></td>
				  <td align="center"><?php echo $row['id'];?></td>
				  <td align="center"><?php echo $row['kitID'];?></td>
				  <td align="middle"></td>
				</tr>				
			  <?php endwhile?>
		</tbody>
		</table>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="Done" value="Done">
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