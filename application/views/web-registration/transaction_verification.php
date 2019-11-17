<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krisibid">
        <meta name="keywords" content="kib,krisibid,id card id">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style-3.css" rel="stylesheet">
    </head>
    <body class="bgimg">
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="text-center">
					<div class="logo">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>
			</div>
		</nav>
		
		<div class="section_bkash">
			<div class="container">
				<div class="row">
					
					<div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
						<div class="bkash_info">
							<h3>Member Bkash Transaction</h3>
							<br />
							<form action="<?php echo base_url();?>Admin/TransactionVerify/member_txn_submit" method='post'>
								<div class="form-group">
									<input type="text" class="form-control" id="txn" name='txn' placeholder="Transaction Id" value='<?php if(isset($txn)){echo $txn; }?>' required>
									<input type="number" class="form-control" id="member_id" name='member_id' placeholder="Member Id" value='<?php if(isset($member_id)){echo $member_id; }?>' required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
							<br />
							
							<table class="table id_search_table" <?php if(!isset($msg)){echo "style='display:none;'";} ?> >
								<tbody>
									<tr class= "even">
										<td style='color:red;'><?php if(isset($msg)){echo $msg; }?></td>
									</tr>				  
								</tbody>
							</table>	
						</div>
					</div>
			
				</div>
			</div>
		</div>
		
		<footer class="container-fluid">
			<div class="row">
				<div class="col-md-12 footer">
					<p>&copy; 2018 Powered By <a href="https://rezanreza.com/">www.rezanreza.com</a></p>
				</div>
			</div>
		</footer>
		<!-- script js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>