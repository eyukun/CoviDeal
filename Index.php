<?php 
SESSION_START();
SESSION_DESTROY();
SESSION_START();
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <title>CoviDeal - The Covid-19 Test Information System</title>
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-3.2.1.min.js'> </script>
	
	<style>
		  body {
		  background-image: url('corona.gif');
		  background-repeat: no-repeat;
		  background-position: center;
		  background-size: 50%;
		  width: 100%;
		  }
	
	</style>
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
 	   </ul>
 			
		<ul class="navbar-nav mr-auto">
      
 	</div>
   </nav>
   
	<!-- body !-->
  <div class = "box">
	  <h1 id="welcome" class="text-center"> Welcome to CoviDeal</h1>
	  <br><br>
	  <div style="text-align:center">
		<a class="login" href="login.php">
		  <span role="button">LogIn</span>
		</a>
	  </div>	
	</div>
	
	<!-- footer !-->
	  <!-- Site footer -->
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