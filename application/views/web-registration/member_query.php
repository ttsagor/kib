<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krisbid">
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
							<h3>Query</h3>
							<br />
							<form action="<?php echo base_url();?>home/member_query_submit" method='post'>
								<div class="form-group">
									<input type="number" class="form-control" id="member_id" name='member_id' placeholder="Member Id" value='<?php if(isset($member_id)){echo $member_id; }?>' required>
									<select id="member_type" name="member_type" class="form-control" style="font-family: &quot;Helvetica Neue&quot;,Roboto,Arial,&quot;Droid Sans&quot;,sans-serif;" required="">
											  <option value="">Select Member Type</option>
                                                <option value="general" <?php if(isset($member_type) && $member_type=='general'){echo "selected"; } ?> >General</option>
                                                <option value="life" <?php if(isset($member_type) && $member_type=='life'){echo "selected"; } ?> >Life</option>											 
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
							<br />
							
							<table class="table id_search_table" <?php if(!isset($msg)){echo "style='display:none;'";} ?> >
								<tbody>
									<tr class= "even">
										<td style='color:green;'><?php if(isset($msg)){echo $msg; }?></td>
									</tr>				  
								</tbody>
							</table>
							<a href='<?php echo base_url(); ?>' class="btn btn-primary" style='color:white;'>Go to Home</a>	
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