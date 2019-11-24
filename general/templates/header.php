 <head>
 	<title>NKG Graphics Order Tracker</title>
 	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
    	.brand{
    		background: #7fcdcd !important;
    	}
    	.brand-text{
    		color: #ffffff !important;
    	}
      textarea {
        width:100%;
        height:150px;
        border:1px solid #CCC;
        background:#FFF;
        margin:0 0 5px;
        padding:10px;
      }
    	form{
    		max-width: 460px;
    		margin: 20px auto;
    		padding: 20px;
    	}
    </style>
 </head>
  <body class = "yellow lighten-5">
  	<nav class = "pink lighten-4 z-depth-1">
  		<div class="container">
  			<a href = 'index.php' class = "brand-log brand-text"><font size = "8">NKG Graphics</font></a>
  			<?php if (isset($_COOKIE['uname'])): ?>
  				<ul id="nav-mobile" class="right hide-on-small-and-down">
  					<li><a href ="signout.php" class ="btn grey z-depth-1">logout</a></li>
  				</ul>
  			<?php endif; ?>
  			<ul id="nav-mobile" class="right hide-on-small-and-down">
  				<li><a href ="contactus.php" class ="btn grey lighten-1 z-depth-1">Contact Us</a></li>
  			</ul>
  			<ul id="nav-mobile" class="right hide-on-small-and-down">
  				<li><a href ="signup.php" class ="btn brand z-depth-1">FOR NOW: Sign up</a></li>
  			</ul>
  		</div>
  	</nav>
  	