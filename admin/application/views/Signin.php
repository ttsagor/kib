<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="kib theme">
		<meta name="keywords" content="kibidcard, bootstrap,template">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/kalpurush.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="bgimg">
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="logo">
						<a href="index.html"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="BB-nav">
					<ul class="nav navbar-nav navbar-right">
						
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="card">
						<form method='post' action='<?php echo $target; ?>'>
							<div class="input-container">
								<input type="text" id="#{label}" name='user_name' required="required" value='<?php if(isset($user_name)){echo $user_name;} ?>'/>
								<label for="#{label}"><span class="fa fa-user-o"></span> USERNAME</label>
								<div class="bar"></div>
							</div>
							<div class="input-container">
								<input type="password" id="#{label}" name='user_password' required="required"/>
								<label for="password"><span class="fa fa-lock"></span> PASSWORD</label>
								<div class="bar"></div>
							</div>
							<div class="input-container">
								<p style='color:red;'><?php if(isset($msg) && $msg!='') {echo $msg; } ?></p>
							</div>
							<div class="cus_button text-center">
								<button type="submit" class="cus_btn btn-primary" onclick="submitVerifation()">SIGN IN</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<footer class="container-fluid">
			<div class="row">
				<div class="col-md-12 footer">
					<p style="font-size:16px;">Powered by: <a href="https://rezanreza.com/" target="blank" style="text-color:#25527B;text-decoration:underline;">Reza &amp; Reza Solutions</a></p>
				</div>
			</div>
		</footer>
		<!-- script js -->
		<script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>